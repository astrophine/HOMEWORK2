<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    protected function create()
    {
        $request = request();
        $propic = $request->has('immagine') ? $request->file('immagine') : null;
        $errori = $this->countErrors($request);

        if(count($errori) === 0) {
            $newUser =  User::create([
            'username' => $request['username'],
            'password' => $request['password'],
            'nome' => $request['nome'],
            'cognome' => $request['cognome'],
            'email' => $request['email'],
            'immagine' => $propic ?? null,
            'numero_opere' => $request['artista_visitatore'],
            ]);
            if ($newUser) {
                Session::put('user_id', $newUser->id);
                Session::put('isartista', $request['artista_visitatore'] == -1 ? false : true);
                return redirect('home');
            } 
            else {
                return view('register')->with('errori',99999);
            }
        }
        else 
            return view('register')->with('errori',$errori); // ->withInput()
        
    }

    private function countErrors($data) {
        $error = array();
        
        # USERNAME
        // Controlla che l'username rispetti il pattern specificato
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $data['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = User::where('username', $data['username'])->first();
            if ($username !== null) {
                $error[] = "Username già utilizzato";
            }
        }
        # PASSWORD
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/', $data['password'])) {
            $error[] = "La password deve essere almeno 8 caratteri. Devono esserci almeno una maiuscola, una minuscola, un numero e un simbolo (!@#$%^&*)";
        } 
        # CONFERMA PASSWORD
        if (strcmp($data["password"], $data["conferma"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        # EMAIL
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = User::where('email', $data['email'])->first();
            if ($email !== null) {
                $error[] = "Email già utilizzata";
            }
        }

        if ($data["artista_visitatore"] != 0  && $data["artista_visitatore"] != -1) {
            $error[] = "Errore selezione";
        }

        return $error;
    }

    public function checkUsername(Request $request) {
        $query = $request['username'];
        return User::where('username', $query)->exists();
        
    }

    public function checkEmail($query) {
        $exist = User::where('email', $query)->exists();
        return ['exists' => $exist];
    }

    public function index() {
        return view('register');
    } 
}
