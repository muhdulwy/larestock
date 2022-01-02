<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function getBarang(Request $request) {
        if ($request->ajax()) {
            $data = Barang::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()->addColumn('action', function($row){
                $actionBtn = '<a class="btn btn-info btn-sm" href="' . route('barang.show',$row->id) . '">Show</a>
                <a href="' . route('barang.edit',$row->id) . '" class="edit btn btn-success btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm btn-delete" data-remote="' . route('barang.destroy',$row->id) . '">Delete</button>';
                return $actionBtn;
            })->rawColumns(['action'])
            ->make(true);
        }
    }

    public function index(Request $request)
    {
        if($request->Barangi){
            $Barangi = '%' . $request->Barangi . '%';
            $barang = Barang::where('nama','like', $Barangi)
                ->paginate(10);
        } else {
            $barang = Barang::latest()->paginate(10);
        }

        return view ('barang.index',compact('barang'))->with('i',(request()->input('page', 1)-1)* 10);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        Barang::create($request->all());

        return redirect()->route('barang.index')->with('succes','Data Berhasil Di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return view('barang.show',compact( 'barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {

        return view('barang.edit')->with('barang', $barang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        $barang->update($request->all());
        
        return redirect()->route('barang.index')->with('succes','Data Berhasil di Update');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('succes','Data Berhasil di Hapus');
    }
}
