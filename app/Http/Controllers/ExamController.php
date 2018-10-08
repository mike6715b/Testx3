<?php
/**
 * ====ExamController====
 * Ovaj controller se koristi za sve zahtjeve koje se odnose na
 * ispite i upravljanje tim ispitima. Takoder za pisanje i
 * provjeru ispita.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Test;

class ExamController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Funkcija odgovorna za stvaranje testova.
     * Dohvaca parametre koje je ucitelj ili admin unjeo
     * i sprema u bazu podataka.
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Funkcija odgovorna za generiranje pitanja. Dohvaca test, zatim pitanja.
     * Randomizira pitanja tako da generira nasumicni niz brojeva od 1 do x
     * (gdje x je ukupan broj pitanja) i onda redosljedom u tom nasumicnom
     * nizu slaze pitanja.
     * Za svako randomizirno pitanje, odmah upisje u Session i tocan odgovor
     * nakon cega nastavlja na sljedece pitanje.
     * Na kraju jos upisuje tip testa (provjera znanja ili samoprovjera)
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
        return view('exam.examgen')->with('questions', $questions_rand);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Redom uz pomoc dowhile petlje prolazi kroz pitanja.
     * Prvi if provjerava dali je korisnik naveo odgovor na pitanje,
     * ako nije petlja nastavlja dalje na iduce pitanje.
     * Ako je korisnik dao odgovor onda dohvaca taj odgovor ili
     * odogovre.
     * Sistem radi na principu ako broj odogovora koje je dao korisnik
     * je jedank broju tocnih odgovora i ako se korisnikovi odgovori i
     * tocni odgovori poklapaju, korisnik dobiva jedan bod.
     * U suprotnom, korisnik ne dobiva bod.
     */
    public function examcheck(Request $request) {
        $score = 0;
        $key = 0;
        do {
            $corrAns = $request->session()->get($key); //Dohvacamo tocne odgovore za pitanje
            $ans = $request->all(); //Dohvacamo odgovore od korisnika
            if (!key_exists($key, $ans['ans'])) { //Provjeravamo dali je korisnik dalo odgovor na pitanje
                $key++;
                continue; //Ako nije, nastavi na drugo pitanje
            }
            $ans = $ans['ans'][$key]; //Ako odg postoji, dohvacamo ga
            if (count($corrAns) == count($ans)) { //Ako je broj tocnih odgovora, jedan broju odgovora koje je dao korisnik
                $contr = [];
                for ($i = 0; $i < count($corrAns); $i++) {
                    if (in_array($ans[$i], $corrAns)) { //Ako odgovor postiji u tocnim odgovorima
                        array_push($contr, "1");
                    }
                }
                $counts = array_count_values($contr);
                if ($counts["1"] == count($corrAns)) {
                    $score++;
                }
            }
            $key++;
        } while ($request->session()->has($key));
        if ($request->session()->get("test_type") == 1) {
            dd("Test type 1");
        } else {

        }
    }
}
