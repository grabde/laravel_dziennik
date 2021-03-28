<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Exception;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        // if($request->post() == null)
        // {
        //     return redirect()->route( route('login') );
        // }

        $publication = DB::table('publication')
        ->orderBy('timestamp', 'desc')
        ->get();
        return view('home'.session('suffix'), ['publication' => $publication]);
    }

    public function marks()
    {
        $subjects = DB::table('subject')->get();
        return view('list_class'.session('suffix'), ['subjects' => $subjects]);
    }

    public function class_N_O()
    {
        session(['id_view' => 'marks_ext']);
        $class = DB::table('class')
        ->select('id_class', 'name')
        ->orderBy('name', 'asc')
        ->distinct()
        ->get('name');
        return view('list_class'.session('suffix'), ['class' => $class]);
    }

    public function class_N_P()
    {
        session(['id_view' => 'choose_date']);
        $class = DB::table('class')
        ->select('id_class', 'name')
        ->orderBy('name', 'asc')
        ->distinct()
        ->get('name');
        return view('list_class'.session('suffix'), ['class' => $class]);
    }

    public function class_N_U()
    {
        session(['id_view' => 'notes_ext']);
        $class = DB::table('class')
        ->select('id_class', 'name')
        ->orderBy('name', 'asc')
        ->distinct()
        ->get('name');
        return view('list_class'.session('suffix'), ['class' => $class]);
    }

    public function notes()
    {
        $notes = DB::table('notes')
        ->where('notes.id_user', session('id'))
        ->orderBy('timestamp', 'desc')
        ->get();
        return view('notes'.session('suffix'), ['notes' => $notes]);
    }

    public function enter_note(Request $request)
    {
        DB::table('notes')
        ->insert(
            [
                'id_user' => session('id_student'),
                'text' => $request->post('note')
            ]
        );
        return view('succes'.session('suffix'));
    }

    public function chosen_date(Request $request)
    {
        $students = DB::table('class')
        ->select('class.id_user', 'users.name', 'users.surname')
        ->join('users', 'users.id', 'class.id_user')
        ->where('class.id_class', session('id_class'))
        ->get();
        session(['sfp' => $students]); //students for enter presence
        
        $persence = DB::table('presence')
        ->select('id_user')
        ->where('date', $request->post('date'))
        ->where('bool', '1')
        ->get();
        session(['swp' => $persence]); //students with persence

        return view('check_presence'.session('suffix'), ['date' => $request->post('date'), 'students' => $students]);
    }

    public function enter_presence(Request $request)
    {
        $date = $request->post('date');
        foreach (session('sfp') as $item){
            if (null !== $request->post($item->id_user)){
                try {
                    DB::table('presence')
                    ->insert(
                        [
                            'date' => $date,
                            'id_user' => $item->id_user,
                            'bool' => '1'
                        ]
                    );
                } 
                catch (\Exception $e) {
                    DB::table('presence')
                    ->where('date', $date)
                    ->where('id_user', $item->id_user)
                    ->update(
                        [
                            'bool' => '1'
                        ]
                    );
                }
            }
            else{
                try {
                    DB::table('presence')
                    ->insert(
                        [
                            'date' => $date,
                            'id_user' => $item->id_user,
                            'bool' => '0'
                        ]
                    );
                } 
                catch (\Exception $e) {
                    DB::table('presence')
                    ->where('date', $date)
                    ->where('id_user', $item->id_user)
                    ->update(
                        [
                            'bool' => '0'
                        ]
                    );
                }
            }
        }
        return view('succes'.session('suffix'));
    }

    public function enter_marks(Request $request)
    {
        $id_subject = session('id_subject');
        //loop at students
        foreach (session('sfm') as $item){
            //loop at marks types
            foreach (session('mtfm') as $item_mt){
                $id = $item->id_user.'_'.$item_mt->id_marks_types;
                $var = $request->post($id);
                try {
                    DB::table('marks')
                    ->insert(
                        [
                            'id_user' => $item->id_user,
                            'id_subject' => $id_subject,
                            'id_marks_types' => $item_mt->id_marks_types,
                            'value' => $var,
                            'timestamp' => null
                        ]
                    );
                } 
                catch (\Exception $e) {
                    $row = DB::table('marks')
                    ->select('value')
                    ->where('id_user', $item->id_user)
                    ->where('id_subject', $id_subject)
                    ->where('id_marks_types', $item_mt->id_marks_types)
                    ->get();
                    if(count($row) != 0)
                    {
                        $value = $row[0]->value;
                        if ($value != $var)
                        {
                            DB::table('marks')
                            ->where('id_user', $item->id_user)
                            ->where('id_subject', $id_subject)
                            ->where('id_marks_types', $item_mt->id_marks_types)
                            ->update(
                                [
                                    'value' => $var,
                                    'timestamp' => null
                                ]
                            );
                        }
                    }
                }
            }
        }
        return view('succes'.session('suffix'));
    }

    //[Student, parents] show schedule
    public function schedule(){
        
        $tab = DB::table('class')
        ->select('id_schedule')
        ->where('id_user', session('id'))
        ->get();

        $id_schedule = $tab[0]->id_schedule;
        
        $schedule = DB::table('schedule')
        ->select('day.id_day', 'day.name', 'subject.name', 'schedule.t_from', 'schedule.t_to')
        ->join('day', 'day.id_day', 'schedule.id_day')
        ->join('subject', 'subject.id_subject', 'schedule.id_subject')
        ->where('schedule.id_schedule', $id_schedule)
        ->orderBy('schedule.id_day', 'asc')
        ->orderBy('schedule.t_from', 'asc')
        ->get();

        $days = DB::table('day')
        ->get();

        return view('schedule'.session('suffix'), ['schedule' => $schedule, 'days' => $days]);
    }

    //[Admin] new user
    public function new_user(){
        return view('new_user'.session('suffix'));
    }

    //[Admin] new user ext
    public function new_user_ext(Request $request){
        $now = Carbon::now();
        $timestamp = $now->format('Y-m-d H:i:s');

        session(['new_user' => $request->post()]);
        $tab_user = session('new_user');

        //check if user exist
        $exist = DB::table('users')
        ->where('email', $tab_user['email'])
        ->where('who', $tab_user['who'])
        ->get();

        if (count($exist) > 0)
        {
            $error = 'Istnieje już taki użytkownik!!!';
            session(['error' => $error]);
            return redirect()->route('new_user');
        }

        switch ($tab_user['who']){
            case 'A':
                //create admin
                try {
                    //insert
                    DB::table('users')
                    ->insert(
                        [
                            'id' => null,
                            'name' => $request->post('name'),
                            'surname' => $request->post('surname'),
                            'email' => $request->post('email'),
                            'password' => Hash::make($request->post('password')),
                            'created_at' => $timestamp,
                            'updated_at' => null,
                            'who' => $request->post('who')
                        ]
                    );

                } 
                catch (\Exception $e) {
                    $error = 'Wystąpił problem podczas dodawnia użytkownika!!!';
                    session(['error' => $error]);
                    return redirect()->route('new_user');
                }
                return view('created_user'.session('suffix'));
            case 'N':
                //create techer
                try {
                    //insert
                    DB::table('users')
                    ->insert(
                        [
                            'id' => null,
                            'name' => $request->post('name'),
                            'surname' => $request->post('surname'),
                            'email' => $request->post('email'),
                            'password' => Hash::make($request->post('password')),
                            'created_at' => $timestamp,
                            'updated_at' => null,
                            'who' => $request->post('who')
                        ]
                    );

                } 
                catch (\Exception $e) {
                    $error = 'Wystąpił problem podczas dodawnia użytkownika!!!';
                    session(['error' => $error]);
                    return redirect()->route('new_user');
                }
                return view('created_user'.session('suffix'));

            case 'U':
                $class = DB::table('class')
                ->select('id_class', 'name')
                ->distinct()
                ->get('name');

                $list_schedule = DB::table('schedule')
                ->select('id_schedule')
                ->distinct()
                ->get('id_schedule');

                return view('new_user_ext_U'.session('suffix'), ['class' => $class, 'list_schedule' => $list_schedule]);
            case 'R':
                $students = DB::table('users')
                ->select('id', 'name', 'surname')
                ->where('who', 'U')
                ->get();
                return view('new_user_ext_R'.session('suffix'), ['students' => $students]);
        }
    }

    //[Admin] create student
    public function create_user_U(Request $request){
        $now = Carbon::now();
        $timestamp = $now->format('Y-m-d H:i:s');

        $user = session('new_user');
        $class = $request->post();

        //insert to users
        try {
            //insert
            DB::table('users')
            ->insert(
                [
                    'id' => null,
                    'name' => $user['name'],
                    'surname' => $user['surname'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                    'created_at' => $timestamp,
                    'updated_at' => null,
                    'who' => $user['who']
                ]
            );

            //get new id user
            $id_user = DB::table('users')
            ->select('id')
            ->where('name', $user['name'])
            ->where('surname', $user['surname'])
            ->where('email', $user['email'])
            ->where('who', $user['who'])
            ->get();

        } 
        catch (\Exception $e) {
            $error = 'Wystąpił problem podczas dodawnia użytkownika!!!';
            session(['error' => $error]);
            return redirect()->route('new_user');
        }

        //insert to class
        try {
            //get name class and schedule
            $name_subject = DB::table('class')
            ->select('name', 'id_schedule')
            ->where('id_class', $class['class'])
            ->get();

            DB::table('class')
            ->insert(
                [
                    'id' => null,
                    'id_class' => $class['class'],
                    'name' => $name_subject[0]->name,
                    'id_user' => $id_user[0]->id,
                    'id_schedule' => $class['schedule']
                ]
            );
        }
        catch (\Exception $e) {
            $error = 'Wystąpił problem podczas dodawnia użytkownika!!!';
            session(['error' => $error]);
            return redirect()->route('new_user');
        }

        return view('created_user'.session('suffix'));
    }

    //[Admin] create parent
    public function create_user_R(Request $request){
        $now = Carbon::now();
        $timestamp = $now->format('Y-m-d H:i:s');

        $user = session('new_user');
        $student = $request->post();

        //insert to users
        try {
            //insert
            DB::table('users')
            ->insert(
                [
                    'id' => null,
                    'name' => $user['name'],
                    'surname' => $user['surname'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                    'created_at' => $timestamp,
                    'updated_at' => null,
                    'who' => $user['who'],
                    'id_child' => $student['students']
                ]
            );

        } 
        catch (\Exception $e) {
            $error = 'Wystąpił problem podczas dodawnia użytkownika!!!';
            session(['error' => $error]);
            return redirect()->route('new_user');
        }

        return view('created_user'.session('suffix'));
    }

    //[Admin] select user
    public function select_user(){
        $users = DB::table('users')
        ->get();
        return view('list_users'.session('suffix'), ['users' => $users]);
    }

    //[Admin] change user
    public function change_user(Request $request){
        $user = DB::table('users')
        ->where('id', $request->post('id_user'))
        ->get();

        switch ($user[0]->who){
            case 'A':
                return view('change_data_AN'.session('suffix'), ['user_data' => $user]);
            case 'N':
                return view('change_data_AN'.session('suffix'), ['user_data'=> $user]);

            case 'U':
                $class = DB::table('class')
                ->where('id_user', $request->post('id_user'))
                ->get();

                $list_class = DB::table('class')
                ->select('id_class', 'name')
                ->distinct()
                ->get('name');

                $list_schedule = DB::table('schedule')
                ->select('id_schedule')
                ->distinct()
                ->get('id_schedule');

                return view('change_data_U'.session('suffix'), ['user_data' => $user, 'class' => $class, 'list_class' => $list_class, 'list_schedule' => $list_schedule]);

            case 'R':
                $child = DB::table('users')
                ->where('id', $user[0]->id_child)
                ->get();

                $students = DB::table('users')
                ->select('id', 'name', 'surname')
                ->where('who', 'U')
                ->get();

                return view('change_data_R'.session('suffix'), ['user_data'=> $user, 'students' => $students, 'child' => $child]);

        }
    }

    //[Admin] update admin teacher
    public function update_AN(Request $request){
        $now = Carbon::now();
        $timestamp = $now->format('Y-m-d H:i:s');
        DB::table('users')
        ->where('id', $request->post('id'))
        ->update(
            [
                'name' => $request->post('name'),
                'surname' => $request->post('surname'),
                'email' => $request->post('email'),
                'updated_at' => $timestamp
            ]
        );
        return view('updated_user'.session('suffix'));
    }

    //[Admin] update student
    public function update_U(Request $request){
        $now = Carbon::now();
        $timestamp = $now->format('Y-m-d H:i:s');
        
        //update user
        DB::table('users')
        ->where('id', $request->post('id'))
        ->update(
            [
                'name' => $request->post('name'),
                'surname' => $request->post('surname'),
                'email' => $request->post('email'),
                'updated_at' => $timestamp
            ]
        );

        //get name class
        $name_class = DB::table('class')
        ->select('name')
        ->where('id_class', $request->post('class'))
        ->get();

        //update class and schedule
        DB::table('class')
        ->where('id_user', $request->post('id'))
        ->update(
            [
                'id_class' => $request->post('class'),
                'name' => $name_class[0]->name,
                'id_schedule' => $request->post('schedule')
            ]
        );

        return view('updated_user'.session('suffix'));
    }

    //[Admin] update parent
    public function update_R(Request $request){
        $now = Carbon::now();
        $timestamp = $now->format('Y-m-d H:i:s');

        DB::table('users')
        ->where('id', $request->post('id'))
        ->update(
            [
                'name' => $request->post('name'),
                'surname' => $request->post('surname'),
                'email' => $request->post('email'),
                'updated_at' => $timestamp,
                'id_child' => $request->post('child')
            ]
        );
        return view('updated_user'.session('suffix'));
    }

    //[Admin] list user to mark to delete
    public function list_users_tmtd(Request $request){
        $users = DB::table('users')
        ->get();

        return view('list_users_tmtd'.session('suffix'), ['users' => $users]);
    }

    //[Admin] del user
    public function del_user(Request $request){
        $users = DB::table('users')
        ->get();

        foreach($users as $item){
            if($request->post($item->id)){
                DB::table('users')
                ->where('id', $request->post($item->id))
                ->delete();
            }
        }

        return view('deleted_user'.session('suffix'));
    }

    //[Admin] new publication
    public function new_publication(){
        return view('new_publication'.session('suffix'));
    }

    //[Admin] create publication
    public function create_publication(Request $request){
        DB::table('publication')
        ->insert(
            [
                'id_publication' => null,
                'publication' => $request->post('publication'),
                'timestamp' => null
            ]
        );
        return view('created_publication'.session('suffix'));
    }

    //[Admin] change publication
    public function change_publication(){
        $publications = DB::table('publication')
        ->orderBy('timestamp', 'desc')
        ->get();

        return view('list_publication'.session('suffix'), ['publications' => $publications]);
    }

    //[Admin] update publication
    public function update_publication(Request $request){
        DB::table('publication')
        ->where('id_publication', $request->post('id'))
        ->update(
            [
                'publication' => $request->post('publication'),
                'timestamp' => null
            ]
        );

        return view('updated_publication'.session('suffix'));
    }

    //[Admin] list publication
    public function list_publication(Request $request){
        $publications = DB::table('publication')
        ->orderBy('timestamp', 'desc')
        ->get();
        return view('publication_tmtd'.session('suffix'), ['publication' => $publications]);
    }

    //[Admin] del publication
    public function del_publication(Request $request){
        $publication = DB::table('publication')
        ->get();

        foreach($publication as $item){
            if($request->post($item->id_publication)){
                DB::table('publication')
                ->where('id_publication', $request->post($item->id_publication))
                ->delete();
            }
        }

        return view('deleted_publication'.session('suffix'));
    }

    //[ALL] mail compose
    public function mail_compose(){
        $users = DB::table('users')
        ->get();
        
        return view('mail_compose', ['users' => $users]);
    }

    //[ALL] send mail
    public function send_mail(Request $request){
        DB::table('mail')
        ->insert(
            [
                'id_mail' => null,
                'id_to' => $request->post('to'),
                'id_from' => session('id'),
                'mail' => $request->post('mail'),
                'timestamp' => null,
                'subject' => $request->post('subject')
            ]
        );

        return view('sent_mail');
    }

    //[ALL] mail received
    public function mail_received(){
        $mails = DB::table('mail')
        ->select('mail.*', 'users.name', 'users.surname')
        ->join('users', 'users.id', 'mail.id_to')
        ->where('mail.id_to', session('id'))
        ->orderBy('mail.timestamp', 'desc')
        ->distinct()
        ->get('subject');

        return view('mail_received', ['mails' => $mails]);
    }

    //[ALL] mail sent
    public function mail_sent(){
        $mails = DB::table('mail')
        ->select('mail.*', 'users.name', 'users.surname')
        ->join('users', 'users.id', 'mail.id_to')
        ->where('mail.id_from', session('id'))
        ->orderBy('mail.timestamp', 'desc')
        ->distinct()
        ->get('subject');

        return view('mail_sent', ['mails' => $mails]);
    }

    //[ALL] reply mail
    public function reply_mail(Request $request){
        $to = DB::table('users')
        ->select('users.id', 'users.name', 'users.surname')
        ->where('users.id', $request->post('to'))
        ->get();

        return view('reply_mail', ['reply' => $request->post(), 'to' => $to]);
    }

    //[ALL] send reply mail
    public function send_reply_mail(Request $request){
        DB::table('mail')
        ->insert(
            [
                'id_mail' => null,
                'id_to' => $request->post('to'),
                'id_from' => session('id'),
                'mail' => $request->post('mail'),
                'timestamp' => null,
                'subject' => $request->post('subject')
            ]
        );

        return view('sent_mail');
    }
}
