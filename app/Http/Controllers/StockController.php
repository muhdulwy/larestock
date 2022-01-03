<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
    public function getStock(Request $request) {
        if ($request->ajax()) {
            $data = Stock::with('barang')->latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()->addColumn('action', function($row){
                $actionBtn = '<a class="btn btn-info btn-sm" href="' . route('stock.show',$row->id) . '">Show</a>
                <a href="' . route('stock.edit',$row->id) . '" class="edit btn btn-success btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm btn-delete" data-remote="' . route('stock.destroy',$row->id) . '">Delete</button>';
                return $actionBtn;
            })->addColumn('barang', function ($row){
                return $row->barang->nama;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function index(Request $request)
    {
        if($request->cari){
            $cari = '%' . $request->cari . '%';
            $stock = Stock::where('status','like', $cari)
                ->orWhere('tgl_order','like', $cari)
                ->orWhere('jumlah','like', $cari)
                // ->orWhere('barangs->nama','like', $cari)
                ->paginate(10);
        } else {
            $stock = Stock::latest()->paginate(10);
        }
        return view ('stock.index',compact('stock'))->with('i',(request()->input('page', 1)-1)* 10);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $status = ['masuk', 'keluar'];
        
        return view('stock.create', compact('barang', 'status'));
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
            'status' => 'required',
            'jumlah' => 'required',
            'tgl_order' => 'required',
            'barang_id' => 'required|exists:barangs,id'
        ]);
        
        Stock::create($request->all());

        return redirect()->route('stock.index')->with('succes','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return view('stock.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $status = ['masuk', 'keluar'];
        $barang = Barang::all();

        return view('stock.edit', compact('status', 'barang'))->with('stock', $stock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'status' => 'required',
            'jumlah' => 'required',
            'tgl_order' => 'required',
            'barang_id' => 'required|exists:barangs,id'
        ]);
        $stock->update($request->all());

        return redirect()->route('stock.index')->with('succes','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stock.index')->with('succes','Data Berhasil di Hapus');
    }
}