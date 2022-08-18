<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Date;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Svi postovi su prikazani.
        //Za vecu aplikaciju potrebna je paginacija.
        $posts = Post::all();
        return view('posts.list', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('posts.create');
        if (Auth::check())
        //Samo ulogirani korisnici mogu stvarati postove.
        //Laravel komponenta stvara upload formu ako je korisnik ulogiran.
        //resources/views/components/posts - Lokacija komponente
        //resources/views/posts Lokacija blade template-a.
        //Ako nije, create metoda vrsi redirect na login.
        {
          return view('posts.create');
        }
        else
        {
          return redirect('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validator fasada preuzima podatke iz request-a i provjerava 
        //je li upload prihvatljiv zadanoj logici.
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'text' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
          ]);

          //U slucaju greske, dolazi do redirecta na istu stranicu ali 
          //sa ubrizganim greskama u kontekst.
          if ($validator->fails()) {
            return redirect('posts/create')
                     ->withErrors($validator)
                     ->withInput();
          }else {


          //Inicijalizacija novog Post objekta.
            // Initialize empty Post object
            $post = new Post();
            // Initialize empty Post object

            // file from the form field
            //Na formi je obavezno naznaciti enctype="multipart/form-data" kako bi file metoda
            //mogla funkcionirati.
            $file = $request->file('image');
            // file from the form field

            // $filename = $request->user()->from_date->format('d/m/Y').$file->getClientOriginalName();

            //Za jedinstvenost naziva posta koristi se Carbon klasa i staticka metoda now
            //koja prolazi kroz toDateTimeString kako bi se DateTime format pretvorio u string.
            //Onda se putem dot konkatenatora zbog deskriptivnosti DateTime stringu dodaje 
            //prvobitni naziv uploadane slike.
            $filename = Carbon::now()->toDateTimeString() . $file->getClientOriginalName();

            //Novo uploadana slika je pomaknuta u images folder. Npr. na heroku-u bi to bio problem
            //zbog koristenja privremenog filesystema. Ovisno o deployment tipu koji se koristi te 
            //obliku i velicini aplikacije nije uvijek moguce koristiti local file storage, vec je
            //potrebno koristiti dedicated servis kao Amazon S3 za koji vec postoji composer paket.
            //Za slucaj da se koristi local filesystem potrebno je konfigurirati Apache/nginx 
            //da prikazuje staticki sadrzaj. 

            $file-> move(public_path('images/'), $filename);
            // $file-> move('/storage/app/public/images/', $filename);

            //Dodavanje podataka u novostvoreni Post objekt.
            //Ista procedura sa Carbon klasom i getClientOriginalName kako bi sami staticki
            //dokument korespondirao Post objektu koji sluzi kao njegov akcesor.

            $post['user_id'] = $request->user()->id;
            $post['title'] = $request->post('title');
            $post['text'] = $request->post('text');
            // $post['name'] = $filename;
            $post['name'] = 'images/' . Carbon::now()->toDateTimeString() . $request->file('image')->getClientOriginalName();
            $post->save();
            //Redirect na posts sa success porukom ubrizganom u kontekst.
            return redirect('/posts')->with('success', "{$post['title']} created.");
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //Post je ubrizgan u kontekst i vidljiv je svakome.
        return view('posts.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // return view('posts.edit', compact('post'));
        //allowDelete Post metod koristi Auth fasadu kako bi provjerila 
        //je li trenutno ulogirani korisnik autor Post instance.
        if ($post->allowDelete(Auth::id()))
        {
          return view('posts.edit', compact('post'));
        }
        else
        {
          return redirect('/posts')->with('error', 'Cannot access. Post does not belong to the current user.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      //Slicna metoda kao i create ali je potrebno prvo pronaci postojecu instancu.
      //Posto se Post objekt sastoji od tekstualnog i datotecnog sadrzaja, update Validator
      //je permisivniji nego create validator kako bi omogucio modificiranje samo teksta / 
      // slike ili oboje.
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|unique:posts|max:255',
            'text' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
          ]);

          if ($validator->fails()) {
            return redirect('posts/create')
                     ->withErrors($validator)
                     ->withInput();
          }else {

          $textFields = ["title", "text"];
  
          //foreach petlja kako ne bi morali duplicirati update logiku za svako
          //tekstualno polje.
          foreach ($textFields as $textField) {
            if ($request->filled($textField))
            {
              $post[$textField] = $request->post($textField);
            }
          }

          //Ako se u requestu nalazi datoteka, koristi se ista logika kao i u create metodi.
          if ($request->file('image'))
          {
            $post['name'] = 'images/' . Carbon::now()->toDateTimeString() . $request->file('image')->getClientOriginalName();
            $file = $request->file('image');
            $filename = Carbon::now()->toDateTimeString() . $file->getClientOriginalName();
            $file-> move(public_path('images/'), $filename);
          }

          $post->save();
          //Post je sacuvan i dolazi do redirecta sa success porukom ubrizganom u kontekst.

            return redirect('/posts')->with('success', "{$post['title']} updated.");
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Metoda provjerava pripada li trenutna Post instanca trenutno ulogiranom korisniku
        if ($post->allowDelete(Auth::id()))
        {
          $post->delete();
          return redirect('/posts')->with('success', "{$post['title']} deleted.");
        }
        else
        {
          return redirect('/posts')->with('error', 'Cannot delete. Post does not belong to the current user.');
        }
    }
}
