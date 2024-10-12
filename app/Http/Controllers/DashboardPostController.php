<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Mail\BlogPosted;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('author_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek isi form
        // return $request;
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        // Jika ada gambar baru (upload)
        if($request->file('image')){
            // simpan ke dalam folder post-images
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        // Jika tidak ada gambar baru, maka biarkan saja

        // Menghapus tag tag yang dapat menganggu/menyerang blog body
        $validateData['body'] = strip_tags($request->body);
        $validateData['author_id'] = auth()->user()->id;
        $post =  Post::create($validateData);

        // Send email to mailtrap
        Mail::to(auth()->user()->email)->send(new BlogPosted($post));

        // Calling method to send chat in telegram
        $this->notify_telegram($post);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // $request merupakan data baru, $post data lama 
    public function update(Request $request, Post $post)
    {
        // $request berisi data baru, $post berisi data dari DB
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];
        
        
        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }
        
        $validateData = $request->validate($rules);

        // Jika ada gambar baru
        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        // Jika tidak ada gambar baru, maka biarkan saja dan eksekusi kode setelahnya

        // abaikan tags atau syntax html didalam body
        $validateData['body'] = strip_tags($request->body);
        $validateData['author_id'] = auth()->user()->id;

        // ubah post where id = $id
        Post::where('id', $post->id)
            ->update($validateData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Jika ada gambar, maka hapus gambar dari folder storage
        if($post->image){
            Storage::delete($post->image);
        }

        // Hapus berdasarkan id 
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    private function notify_telegram($post){
        $botApiToken = "8086284849:AAHCXq5lrgwD6aj_4DJKw4h7-FxiMZmQ1uY";
        $url = "https://api.telegram.org/bot{$botApiToken}/sendMessage";
        $chatId = "-1002493086884";
        $content = "Ada postingan baru nih di blog kamu dengan judul: <strong>\"{$post->title}\"</strong>";
        $data = [
            'chat_id'       => $chatId,
            'text'          => $content,
            'parse_mode'    => "HTML"
        ];

        Http::post($url, $data);
    }
}
