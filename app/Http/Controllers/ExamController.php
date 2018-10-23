<?php
/**
 * ====ExamController====
 * Ovaj controller se koristi za sve zahtjeve koje se odnose na
 * ispite i upravljanje tim ispitima. Takoder za pisanje i
 * provjeru ispita.
 */
namespace App\Http\Controllers;

use App\TestDone;
use Illuminate\Http\Request;
use App\Question;
use App\Test;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Funkcija odgovorna za stvaranje testova.
     * Dohvaca parametre koje je ucitelj ili admin unjeo
     * i sprema u bazu podataka.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function examcreate(Request $request) {
        // Dohvacamo sve sto je korisnik upisao
        $title = $request->title;
        $class = json_encode($request->class);
        $subject = $request->subject;
        $field = $request->field;
        $type = $request->type;

        // Dohvacamo pitanja koja je korisnik odabrao
        $question = Question::where('ques_subj_id', '=', $subject)->where('ques_field_id', '=', $field)->pluck('ques_id');

        // Unosimo novi test u bazu
        $exam = new Test;
        $exam->test_title = $title;
        $exam->test_class = $class;
        $exam->test_ques = $question[0];
        $exam->test_type = $type;
        $exam->status = 1;
        $exam->save();  //Spremanje

        return redirect()->route('mainmenu.exam');  //Preusmjeravanje na */mainmenu/exam
    }

    /**
     * Funkcija odgovorna za generiranje pitanja. Dohvaca test, zatim pitanja.
     * Randomizira pitanja tako da generira nasumicni niz brojeva od 1 do x
     * (gdje x je ukupan broj pitanja) i onda redosljedom u tom nasumicnom
     * nizu slaze pitanja.
     * Za svako randomizirno pitanje, odmah upisje u Session i tocan odgovor
     * nakon cega nastavlja na sljedece pitanje.
     * Na kraju jos upisuje tip testa (provjera znanja ili samoprovjera)
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function examgen(Request $request) {
        $test = Test::where('test_id', '=', $request->id)->first();
        $questionRow = Question::where('ques_id', '=', $test->test_ques)->first();
        $questions = json_decode($questionRow->ques_questions, TRUE);
        // RANDOMIZING QUESTIONS
        $ques_nums = [];
        for ($i = 0; $i < count($questions); $i++) {
            do {
                $num = rand(1, count($questions));
            } while (in_array($num, $ques_nums));
            $ques_nums[$i] = $num;
        }
        for ($i = 0; $i < count($questions); $i++) {
            $ques_num = $ques_nums[$i];
            $ques = $questions[$ques_num];
            $questions_rand[$i] = $ques;
        }
        for ($i = 0; $i < count($questions_rand); $i++) {
            $request->session()->put($i, $questions_rand[$i]['correct']);
        }
        $request->session()->put('test_type', $test->test_type);
        $request->session()->put('ques_id', $request->id);
        $request->session()->put('ques_rand', json_encode($questions_rand));
        $request->session()->put('test_id', $request->id);
        return view('exam.examgen')->with('questions', $questions_rand);
    }

    /**
     * Redom uz pomoc dowhile petlje prolazi kroz pitanja.
     * Prvi if provjerava dali je korisnik naveo odgovor na pitanje,
     * ako nije petlja nastavlja dalje na iduce pitanje.
     * Ako je korisnik dao odgovor onda dohvaca taj odgovor ili
     * odogovre.
     * Sistem radi na principu ako broj odogovora koje je dao korisnik
     * je jedank broju tocnih odgovora i ako se korisnikovi odgovori i
     * tocni odgovori poklapaju, korisnik dobiva jedan bod.
     * U suprotnom, korisnik ne dobiva bod.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function examcheck(Request $request) {
        $score = 0; $key = 0;
        $result = $this->CheckAns($request, $score, $key);
        $score = $result[0] / $result[1];
        if ($request->session()->get("test_type") == 1) {
            if ($score < 0.5) {
                $grade = 1;
            } elseif ($score > 0.5 && $score < 0.65) {
                $grade = 2;
            } elseif ($score > 0.65 && $score < 0.75) {
                $grade = 3;
            } elseif ($score > 0.75 && $score < 0.90) {
                $grade = 4;
            } else {
                $grade = 5;
            }
            $testDone = new TestDone();
            $testDone->test_id = $request->session()->get('test_id');
            $testDone->test_user_id = Auth::user()->user_id;
            $testDone->test_grade = $grade;
            $testDone->test_anses = json_encode($request->all()['ans']);
            date_default_timezone_set('CET');
            $testDone->test_complete = date('d/m/Y h:i:s');
            $testDone->save();
            //dd($testDone);
            $questions = $request->session()->get('ques_rand');
            $questions = json_decode($questions, TRUE);
            return view('exam.examresult')
                ->with('questions', $questions)
                ->with('anses', $request->all()['ans'])
                ->with('score', $result[0])
                ->with('numOfAns', $result[1]);
        } else {
            $questions = $request->session()->get('ques_rand');
            $questions = json_decode($questions, TRUE);
            return view('exam.examresult')
                ->with('questions', $questions)
                ->with('anses', $request->all()['ans'])
                ->with('score', $result[0])
                ->with('numOfAns', $result[1]);
        }
    }

    public function deactivate(Request $request) {
        $id = $request->id;
        Test::where('test_id', '=', $id)->update(['status' => 0]);
        return redirect()->route('mainmenu.exam');
    }

    public function activate(Request $request) {
        $id = $request->id;
        Test::where('test_id', '=', $id)->update(['status' => 1]);
        return redirect()->route('mainmenu.exam');
    }

    public function delete(Request $request) {
        Test::destroy($request->id);
        TestDone::where('test_id', '=', $request->id)->delete();
        return redirect()->route('mainmenu.exam');
    }

    /**
     * Nakon sto dobijemo $request varijablu, iz nje povlacimo odgovore
     * korisnika i tocne odgovore. Prva provjera je da utvrdimo da je korisnik
     * dao odgovor na pitanje. Ako nije nastavljamo da iduce pitanje.
     * Provjeravamo dali broj odgovora korisnika je jednak broju tocnih
     * odgovora. Ako nije nastavljamo na seljedece pitanje.
     * Za svaki odgovor korisnika koji je medu tocnim odgoovorima dodjeljuje
     * broj 1 u varijablu $control. Nakon toga preborjavamo koliko ima
     * jedinica (tocno) i nula (netocno). Ako broj jedinica je jednak broju
     * tocnih odgovora, dodjeljujemo bod preko varijable $score.
     *
     * @param $request
     * @param $score
     * @param $key
     * @param array $cor
     * @return array
     */
    protected function CheckAns($request, $score, $key, $cor = []) {
        do {
            $userAns = $request->all()["ans"]; //Dohvacamo odgovore od korisnika
            $corrAns = $request->session()->get($key); //Dohvacamo tocne odgovore za pitanje
            if (!key_exists($key, $userAns)) { //Provjeravamo dali je korisnik dalo odgovor na pitanje
                $key++;
                continue; //Ako nije, nastavi na drugo pitanje
            }
            if (count($corrAns) == count($userAns[$key])) { //Ako je broj tocnih odgovora, jedan broju odgovora koje je dao korisnik
                $control = []; //Koristimo za provjeru koliko ima tocnih/netocnih odgovora
                for ($i = 0; $i < count($corrAns); $i++) {
                    if (in_array($userAns[$key][$i], $corrAns)) { //Ako odgovor postiji u tocnim odgovorima
                        array_push($control, 1);
                    }
                }
                $counts = array_count_values($control); //Prebroji tocne i netocne odgovore
                if (key_exists(1, $counts)) { //Ako ima tocnih odgovora
                    if ($counts[1] == count($corrAns)) { //Ako smo tocno ondgovorili na isti broj tocni
                        $score++;
                        array_push($cor, $key);
                    }
                }
            }
            $key++;
        } while ($request->session()->has($key));
        $request->session()->put('corrects', $cor);
        $return = [$score, $key];
        return $return;
    }
}
