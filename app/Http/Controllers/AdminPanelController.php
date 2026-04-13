<?php

namespace App\Http\Controllers;
use App\Models\ProductModel;
use App\Models\PincodeModel;
use App\Models\CheckoutModel;
use App\Models\FeedbackModel;
use App\Models\CartModel;
use App\Models\ProductEntryModel;
use App\Models\CustomerRegModel;
use Illuminate\Http\Request;

class AdminpanelController extends Controller
{
    
    public function product ()
    {
        $product = ProductModel::all();
        return view('AdminPanel.product', compact('product'));
    }

    public function adminindex()
    {
        $totalOrders = CheckoutModel::count();
        $totalCustomers = CustomerRegModel::count();
        $totalProducts = ProductEntryModel::count();
        $totalRevenue = CheckoutModel::sum('total');

        // Fetch sales data for the last 7 days for the chart
        $salesData = CheckoutModel::selectRaw('DATE(orderdate) as date, SUM(total) as sum')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get()
            ->reverse();

        $chartLabels = $salesData->pluck('date')->toArray();
        $chartValues = $salesData->pluck('sum')->toArray();

        // Recent orders
        $recentOrders = CheckoutModel::orderBy('created_at', 'desc')->take(5)->get();

        return view('adminpanel.index', compact(
            'totalOrders', 
            'totalCustomers', 
            'totalProducts', 
            'totalRevenue',
            'chartLabels',
            'chartValues',
            'recentOrders'
        ));
    }

    public function insertproduct(Request $request)

{
    $validate = $request->validate(['productname'=> 'required||unique:product_models||min:3']);
    
    $s=new ProductModel;
    $s->productname=$request->input('productname');
    $s->save();
    return redirect ('/product')->with('status','Product added Sucessfully');
}
public function destroy ($id)
{
    $del=ProductModel::find($id);
    $del->delete();
    return redirect ('/product')->with('status','Product delete Sucessfully');  
}
public function edit ($id)
{
    $edit=ProductModel::find($id);
   return view ('adminpanel.edit', compact('edit') );
}
public function update (Request $request,$id)
{
    $update=ProductModel::find($id);
    $update->productname=$request->input('productname');
    $update->update();
    return redirect ('/product')->with('status', 'Product Updated Suceesfully');
}
//pincode

public function Pincode()
{
    $Pincode = PincodeModel::all();
    return view('adminpanel.Pincode', compact('Pincode'));
}
public function insertPincode(Request $request)

{
    $validate = $request->validate(['Pincode'=> 'required||unique:Pincode_models||min:6||numeric']);
    $s =new PincodeModel;
    $s->Pincode=$request->input('Pincode');
    $s->save();
    return redirect ('/Pincode')->with('status','Pincode added Sucessfully');
}
public function destroyPincode ($id)
{
    $del=PincodeModel::find($id);
    $del->delete();
    return redirect ('/Pincode')->with('status','Pincode delete Sucessfully');  
}
public function editPincode ($id)
{
    $edit_pincode=PincodeModel::find($id);
    return view('adminpanel.editPincode', compact('edit_pincode'));
}
public function updatePincode (Request $request,$id)
{
    $update=PincodeModel::find($id);
    $update->pincode=$request->input('Pincode');
    $update->update();
    return redirect ('/Pincode')->with('status', 'Pincode Updated Suceesfully');
}

// productentry

public function productentry()
{
    $data = ProductModel::all();
    return view('adminpanel.productentry', compact('data'));
}


public function insertproductentry(Request $request)

{
   // $validate = $request->validate(['category'=> 'required|max:50','pnameid'=>'required|max:50','company'=>'required|max:50','color'=>'required|max:50','material'=>'required|max:50','size'=>'required|max:50','description'=>'required|max:50','image'=>'required|max:50','image1'=>'required|max:50','image2'=>'required|max:50','image3'=>'required|max:50','image4'=>'required|max:50','price'=>'required|max:50']);

    
    $product=new ProductEntryModel;
    
    $product->pnameid=$request->input('pnameid');
   
    $product->size=$request->input('size');
  
    // Initialize all image fields to avoid "no default value" errors
    $product->image = "";
    $product->image1 = "";
    $product->image2 = "";
    $product->image3 = "";
    $product->image4 = "";

    if($request->hasFile('image')) {
        $file = $request->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = rand(11111,99999).'.'.$extenstion;
        $file->move('image_upload/', $filename);
        $product->image = $filename;
    }

    if($request->hasFile('image1')) {
        $file1 = $request->file('image1');
        $extenstion = $file1->getClientOriginalExtension();
        $filename1 = rand(11111,99999).'.'.$extenstion;
        $file1->move('image_upload/', $filename1);
        $product->image1 = $filename1;
        // If 'image' is still empty, use 'image1' as primary
        if($product->image == "") $product->image = $filename1;
    }

    if($request->hasFile('image2')) {
        $file2 = $request->file('image2');
        $extenstion = $file2->getClientOriginalExtension();
        $filename2 = rand(11111,99999).'.'.$extenstion;
        $file2->move('image_upload/', $filename2);
        $product->image2 = $filename2;
    }

    if($request->hasFile('image3')) {
        $file3 = $request->file('image3');
        $extenstion = $file3->getClientOriginalExtension();
        $filename3 = rand(11111,99999).'.'.$extenstion;
        $file3->move('image_upload/', $filename3);
        $product->image3 = $filename3;
    }

    if($request->hasFile('image4')) {
        $file4 = $request->file('image4');
        $extenstion = $file4->getClientOriginalExtension();
        $filename4 = rand(11111,99999).'.'.$extenstion;
        $file4->move('image_upload/', $filename4);
        $product->image4 = $filename4;
    }
    
    $product->price = $request->input('price');
    $product->save();

    return redirect ('/productentry')->with('status','Product added Sucessfully');
}
 

//productentryview
public function productentryview()
{
    $productentryview = ProductEntryModel::with('product_entry')->get();
    return view('adminpanel.productentryview', compact('productentryview'));
}


public function insertproductentryview(Request $request)

{
   // $validate = $request->validate(['category'=> 'required|max:50','pnameid'=>'required|max:50','company'=>'required|max:50','color'=>'required|max:50','material'=>'required|max:50','size'=>'required|max:50','description'=>'required|max:50','image'=>'required|max:50','image1'=>'required|max:50','image2'=>'required|max:50','image3'=>'required|max:50','image4'=>'required|max:50','price'=>'required|max:50']);

    
    $product=new ProductEntryModel;
    $product->pnameid=$request->input('pnameid');
    $product->size=$request->input('size');
    
    // Initialize all image fields to avoid "no default value" errors
    $product->image = "";
    $product->image1 = "";
    $product->image2 = "";
    $product->image3 = "";
    $product->image4 = "";

    if($request->hasFile('image1')) {
        $file1 = $request->file('image1');
        $extenstion = $file1->getClientOriginalExtension();
        $filename1 = rand(11111,99999).'.'.$extenstion;
        $file1->move('image_upload/', $filename1);
        $product->image1 = $filename1;
        $product->image = $filename1; // Use as primary too
    }
    
    $product->price=$request->input('price');
    $product->save();

    return redirect ('/productentryview')->with('status','Product added Sucessfully');
}
public function destroyproductentryview($id)
{
    $del=ProductEntryModel::find($id);
    $del->delete();
    return redirect ('/productentryview')->with('status','product delete Sucessfully');  
}
public function editproductentryview($id)
{
    $edit = ProductEntryModel::find($id);
    return view('adminpanel.editproductentryview', compact('edit'));
}
public function updateproductentryview(Request $request, $id)
{
    $update = ProductEntryModel::find($id);
    $update->company = $request->input('company');
    $update->color = $request->input('color');
    $update->material = $request->input('material');
    $update->size = $request->input('size');
    $update->price = $request->input('price');
    
    if($request->hasFile('image')) {
        $file = $request->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = rand(11111,99999).'.'.$extenstion;
        $file->move('image_upload/', $filename);
        $update->image = $filename;
    }
    
    $update->update();
    return redirect ('/productentryview')->with('status', 'Product Updated Successfully');
}


public function customerview()
{
    $customerview = CustomerRegModel::all();
    return view('adminpanel.customerview', compact('customerview'));
}



public function destroyregister($id)
{
    $del=CustomerRegModel::find($id);
    $del->delete();
    return redirect ('/customerview')->with('status','Register delete Successfully');  
}


public function customerorder()
{
    $order = CheckoutModel::all();
    return view('adminpanel.customerorder', compact('order'));
}

public function customerorderdetail($id)
{
    $order = CartModel::where(['billno'=>$id])->get();
    return view('adminpanel.customerorderdetail', compact('order'));
}
public function process_status($id)
{
    $sta = CartModel::find($id);
    if($sta)
    {
        if($sta->pstatus)
        {
            $sta->pstatus = "process";
        }
        else
        {
            $sta->pstatus = "order";
        }
        $sta->save();
    }
    return back();
} 

public function dispatch_status($id)
{
    $sta = CartModel::find($id);
    if($sta)
    {
        if($sta->pstatus)
        {
            $sta->pstatus = "dispatch";
        }
        else
        {
            $sta->pstatus = "process";
        }
        $sta->save();
    }
    return back();
} 

public function deliver_status($id)
{
    $sta = CartModel::find($id);
    if($sta)
    {
        if($sta->pstatus)
        {
            $sta->pstatus = "deliver";
        }
        else
        {
            $sta->pstatus = "dispatch";
        }
        $sta->save();
    }
    return back();
}

public function customerfeedback()
{
    $feedback1 = FeedbackModel::all();
    return view('adminpanel.customerfeedback', compact('feedback1'));
}
}





