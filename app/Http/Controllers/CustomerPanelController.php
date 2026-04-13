<?php

namespace App\Http\Controllers;

use App\Models\CustomerRegModel;
use App\Models\ProductEntryModel;
use App\Models\ProductModel;
use App\Models\CheckoutModel;
use App\Models\PincodeModel;
use App\Models\FeedbackModel;
use App\Models\CartModel;
use DB;
use Illuminate\Http\Request;
use Session;


class CustomerPanelController extends Controller
{
    public function customerindex()
    {
        return view('customerpanel.customerindex');                                
    }

    public function customerlogout(Request $request)
{
$request->session()->flush();
Session::forget('CustomerLogginId');
return redirect('login');
}  

public function profile()
{
    $id = Session::get('CustomerLogginId')['id'];
    $view = CustomerRegModel::where('id', $id)->get();
    return view('customerpanel.profile', compact('view'));                                
}

public function changepassword()
    {
        
       return view('customerpanel.changepassword');
      
    }
    public function updatepassword(Request $request)
    {

        $request->validate([
            'newpassword' => 'required|min:6',
        ]);

        try {
            $id = Session::get('CustomerLogginId')['id'];
            $admin = CustomerRegModel::find($id);
            $admin->password = $request->newpassword;
            $admin->save();
            
            $request->session()->flash('success', 'Password Changed Successfully');
            $request->session()->put('CustomerLogginId', $admin);
            return view('customerpanel.changepassword');

        } catch (\Exception $e) {
            $request->session()->flash('er', $e->getMessage());
            return view('customerpanel.changepassword');

        }

    }
    public function editprofile ()
{
    $id = Session::get('CustomerLogginId')['id'];
    $edit=CustomerRegModel::find($id);
   return view ('customerpanel.editprofile', compact('edit') );
}
public function updateprofile (Request $request)
{
    $id = Session::get('CustomerLogginId')['id'];
    $update=CustomerRegModel::find($id);
    $update->name=$request->input('name');
    $update->address=$request->input('address');
    $update->city=$request->input('city');
    $update->update();
    
    // Update session data too
    $request->session()->put('CustomerLogginId', $update);
    
    return redirect ('/profile')->with('status', 'Profile Updated Successfully');
}


//viewproduct

public function viewproduct()
{
    $product_entry = ProductEntryModel::with('product_entry')->get();
    // In this database, ProductModel stores the category names in the 'productname' field
    $categories = ProductModel::pluck('productname');
    return view('customerpanel.viewproduct', compact('product_entry', 'categories'));
}

    public function addtocart(Request $request)
    {
        if ($request->session()->has('CustomerLogginId')) {
            $product = ProductEntryModel::find($request->productid);
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            $check = CartModel::where([
                'productid' => $request->productid,
                'pstatus' => 'cart',
                'userid' => $request->session()->get('CustomerLogginId')['id']
            ])->first();

            if ($check) {
                $s = CartModel::find($check->id);
                $s->qty = $s->qty + 1;
                $s->update();
            } else {
                $cart = new CartModel;
                $cart->userid = $request->session()->get('CustomerLogginId')['id'];
                $cart->productid = $request->productid;
                $cart->qty = $request->productqty;
                $cart->pprice = $product->price; // Use database price
                $cart->billno = '0';
                $cart->pstatus = 'cart';
                $cart->save();
            }
            return redirect('/viewproduct')->with('status', 'Product added to cart successfully');
        }
        return redirect('/login');
    }

// viewdetail

public function viewdetail($id, $name = null)
{
    $item = ProductEntryModel::with('product_entry')->find($id);
    return view('customerpanel.viewdetail', compact('item'));
}


public static function cartitem()
{
    $id= Session::get('CustomerLogginId')['id'];
    return CartModel::where(['userid'=>$id, 'pstatus'=>'cart'])->count();
}

public static function viewcart(Request $request)
{
    $id= Session::get('CustomerLogginId')['id'];
    $data2 = PincodeModel::all();
    $cust=CartModel::where(['userid'=>$id, 'pstatus'=>'cart'])->get();

    return view('customerpanel.addtocart', compact('cust', 'data2'));
}

public function qty()
{
    $qty = CustomerRegModel::with('product_entry')->get();
    return view('customerpanel.qty', compact('qty'));
}

public function editqty($id)
{
    $edit = CartModel::find($id);
   return view ('customerpanel.editqty', compact('edit') );
}
    public function updateqty(Request $request, $id)
    {
        $update = CartModel::find($id);
        $update->qty = $request->input('qty');
        $update->update();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect('/addtocart')->with('status', 'Quantity Updated Successfully');
    }

public function deleteaddtocart($id)
{
    $del=CartModel::find($id);
    $del->delete();
    return redirect ('/addtocart')->with('status','Quantity delete Sucessfully');  
}



    public function checkoutinsertdata(Request $request)
    {
        if ($request->session()->has('CustomerLogginId')) {
            if ($request->total <= 0) {
                return redirect()->back()->with('error', 'Cannot process empty cart.');
            }
            
            $cart = new CheckoutModel;
            $cart->custid = $request->session()->get('CustomerLogginId')['id'];
            $cart->custname = $request->custname;
            $cart->address = $request->address;
            $cart->mobileno = $request->mobileno;
            $cart->custemail = $request->custemail;
            $cart->pincode = $request->pincode;
            $cart->billno = $request->billno;
            $cart->shippingtype = $request->shippingtype;
            $cart->total = $request->total;
            $cart->orderdate = $request->orderdate;

            $cart->save();

            // cart update
            $checkoutid = $cart->id;
            $cart->billno = $checkoutid;
            $cart->update();

            $updatearray = [
                'billno' => $checkoutid,
                'pstatus' => 'order'
            ];
            DB::table('cart_models')->where(['userid' => $cart->custid, 'pstatus' => 'cart', 'billno' => '0'])->update($updatearray);

            // Optional: Send Email Notification
            try {
                \Mail::to($cart->custemail)->send(new \App\Mail\OrderPlaced($cart));
            } catch (\Exception $e) {
                // Silently fail if mail server is not configured, to not break checkout
            }

            return redirect('viewproduct')->with('status', 'Checkout Successfully');
        }
    }

public function myorder()
{
    $id= Session::get('CustomerLogginId')['id'];
    $cust=CheckoutModel::where('custid', $id)
            ->where('total', '>', 0)
            ->orderBy('id', 'desc')->get();

    return view('customerpanel.myorder', compact('cust'));

}

public function vieworderdetail($id)
{
    $userid = Session::get('CustomerLogginId')['id'];
    $vieworderdetail1 = CartModel::where(['billno'=>$id, 'userid'=>$userid])->get();

    return view('customerpanel.vieworderdetail', compact('vieworderdetail1'));
}

public function bill($id)
{
   $userid = Session::get('CustomerLogginId')['id'];
   $cust = CheckoutModel::where(['billno' => $id, 'custid' => $userid])->get();
   $cust1 = CartModel::where(['billno' => $id, 'userid' => $userid])->get(); 
  return view('customerpanel.bill',  compact('cust', 'cust1'));
}


public function pstatus($id)
{
    $userid = Session::get('CustomerLogginId')['id'];
    $sta = CartModel::where(['id' => $id, 'userid' => $userid])->first();
    if($sta)
    {
        if($sta->pstatus)
        {
            $sta->pstatus = 'cancel';
        }
        else
        {
            $sta->pstatus = 'order';
        }
        $sta->save();
    }
    return back();
}


public function userprofile ()
{
    return view('customerpanel.userprofile');
}

public function feedback()
{
    $feedback = FeedbackModel::all();
    return view('customerpanel.feedback', compact('feedback'));
}

public function feedbackinsert(Request $request)

{
    $validate = $request->validate(['custname'=> 'required', 'mobileno'=>'required||numeric', 'custemail'=>'required', 'description'=>'required']);
    $s =new FeedbackModel;
    $s->custname=$request->input('custname');
    $s->mobileno=$request->input('mobileno');
    $s->custemail=$request->input('custemail');
    $s->description=$request->input('description');
    $s->save();
    return redirect ('/feedback')->with('status','FeedBack added Sucessfully');
}
}