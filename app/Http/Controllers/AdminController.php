<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Gallary;
use App\Models\Contact;
use Notification;
use App\Notifications\SendEmailNotification;


class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                $room = Room::all();
                $gallary = Gallary::all();  // Pastikan mengambil data galeri

                return view('home.index', compact('room', 'gallary'));
            }

            else if ($usertype == 'admin') {
                return view('admin.index');
            }

            else {
                return redirect()->back();
            }
        }
    }

    public function home()
    {
        $room = Room::all();
        $gallary = Gallary::all();  // Mengambil data galeri untuk ditampilkan

        return view('home.index', compact('room', 'gallary'));  // Pastikan variabel 'gallary' dikirim ke view
    }

    public function create_room()
    {
        return view('admin.create_room');
    }

    public function add_room(Request $request)
    {
        $data = new Room();

        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back();
    }

    public function view_room()
    {
        $data = Room::all();
        return view('admin.view_room', compact('data'));
    }

    public function room_delete($id)
    {
        $data = Room::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function room_update($id)
    {
        $data = Room::find($id);
        return view('admin.update_room', compact('data'));
    }

    public function edit_room(Request $request, $id)
    {
        $data = Room::find($id);

        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back();
    }

    public function bookings()
    {
        $data = Booking::all();
        return view('admin.booking', compact('data'));
    }

    public function delete_booking($id)
    {
        $data = Booking::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function approve_book($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'approve';
        $booking->save();   

        return redirect()->back();
    }

    public function reject_book($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'rejected';
        $booking->save();   

        return redirect()->back();
    }

    public function warning_book($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'warning';
        $booking->save();   

        return redirect()->back();
    }

    // Untuk melihat galeri
    public function view_gallary()
    {
        $gallary = Gallary::all();  // Ambil semua data galeri
        return view('admin.gallary', compact('gallary'));  // Kirim data galeri ke view
    }

    // Untuk meng-upload gambar galeri
    public function upload_gallary(Request $request)
    {
        $data = new Gallary;
        
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('gallary', $imagename);
            $data->image = $imagename;
            $data->save();
            return redirect()->back();  // Setelah upload, kembali ke halaman yang sama
        }
    }

    // Untuk menghapus gambar galeri
    public function delete_gallary($id)
    {
        $data = Gallary::find($id);
        $data->delete();

        return redirect()->back();  // Kembali setelah menghapus gambar
    }

    public function all_messages()
    {
        $data = Contact::all();
        return view('admin.all_message', compact('data'));
    }

    public function send_mail($id)
    {
        $data = Contact::find($id);
        return view('admin.send_mail', compact('data'));
    }

    public function mail(Request $request,$id)
    {
        $data = Contact::find($id);

        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'endline' => $request->endline,
        ];

        Notification::send($data, new SendEmailNotification($details));

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
