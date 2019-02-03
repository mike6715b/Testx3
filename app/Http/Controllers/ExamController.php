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
        session_unset(); //Unset potential old session data
        $test = Test::where('test_id', '=', $request->id)->first(); //Dohvati test koji je korisnik zatrazio
        $questionRow = Question::where('ques_id', '=', $test->test_ques)->first(); //Dohvati pitanja koja odgovaraju tom testu
        $questions = json_decode($questionRow->ques_questions, TRUE); //decode json-a
        shuffle($questions); // RANDOMIZING QUESTIONS
        $questions_rand = array();
        foreach ($questions as $question) { //Randomizacija svakih odgovora
            $list = $question["ans"];
            $random = $this->shuffle_assoc($list);
            unset($question["ans"]);
            $question["ans"] = $random;
            array_push($questions_rand, $question);
        }
        $request->session()->put('test_type', $test->test_type);
        $request->session()->put('test_id', $request->id);
        $request->session()->put('ques', json_encode($questions_rand));

        return view('exam.examgen')->with('questions', $questions_rand);
    }

    protected function shuffle_assoc($list) {
        if (!is_array($list)) return $list;

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key) {
            $random[$key] = $list[$key];
        }
        return $random;
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
        //dd($request);
        $result = $this->CheckAns($request);
        $score = $result[0] / $result[1];
        $anses = $request->all();
        unset($anses['_token']);
        unset($anses['sub-btn']);
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
            $testDone->test_anses = json_encode($anses);
            date_default_timezone_set('CET');
            $testDone->test_complete = date('d/m/Y h:i:s');
            $testDone->save();
            $questions = $request->session()->get('ques');
            $questions = json_decode($questions, TRUE);
            return view('exam.examresult')
                ->with('questions', $questions)
                ->with('anses', $request->all())
                ->with('score', $result[0])
                ->with('numOfAns', $result[1])
                ->with('questionScores', $result[2]);
        } else {
            $questions = json_decode($request->session()->get('ques'), TRUE);
            return view('exam.examresult')
                ->with('questions', $questions)
                ->with('anses', $request->all())
                ->with('score', $result[0])
                ->with('numOfAns', $result[1])
                ->with('questionScores', $result[2]);
        }
    }

    public function deactivateTest(Request $request) {
        $id = $request->id;
        Test::where('test_id', '=', $id)->update(['status' => 0]);
        return redirect()->route('mainmenu.exam');
    }

    public function activateTest(Request $request) {
        $id = $request->id;
        Test::where('test_id', '=', $id)->update(['status' => 1]);
        return redirect()->route('mainmenu.exam');
    }

    public function deleteTest(Request $request) {
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
     * @return array
     */
    protected function CheckAns($request, $score = 0, $key = 0) {
        $questions = json_decode($request->session()->get('ques'));
        $scoresQuestions = array();
        for ($i = 0; $i < count($questions); $i++) {
            $questionScore = 0;
            if (!$request->$i) { // Provjeravamo dali je korisnik dao odgovor na pitanje
                continue;
            }
            $userAns = $request->$i; // Odgovori korisnika
            $questionCorrect = $questions[$i]->correct; // Tocni odgovori na pitanje
            foreach ($userAns as $ans) {
                if (in_array($ans, $questionCorrect)) {
                    $questionScore++;
                } else {
                    $questionScore--;
                }
            }
            $questionScore = $questionScore / count($questionCorrect);
            $score += $questionScore;
            array_push($scoresQuestions, $questionScore);
        }
        $quesCount = count($questions);
        $return = [$score, $quesCount, $scoresQuestions];
        return $return;
    }
}
