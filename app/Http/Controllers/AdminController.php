<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/* Models */
use File;
use App\Records;
use App\ContactPerson;
use App\User;
use App\UserProfile;
use App\SeedSampling;

use App;
/* plugin */
use Yajra\Datatables\Datatables;

class AdminController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['base_url'] = App::make("url")->to('/');
        $data['prof_pic'] = UserProfile::where('user_id', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

        return view('admin.dashboard', $data);
    }

    public function adminProfile()
    {
        $data['title'] = "Admin Profile";
        $data['base_url'] = App::make("url")->to('/');
        $data['data'] = DB::table('user_profile')
            ->join('civil_status', 'user_profile.user_civil_status', '=', 'civil_status.id')
            ->join('barangays', 'user_profile.user_brgy', '=', 'barangays.id')
            ->selectRaw('user_profile.id,
                        user_profile.user_id,
                        user_profile.user_profile_pic,
                        user_profile.user_birthdate,
                        user_profile.user_gender,
                        user_profile.user_address,
                        user_profile.user_street,
                        user_profile.user_mobile_num,
                        user_profile.user_phone_num,
                        user_profile.user_civil_status,
                        user_profile.user_brgy,
                        barangays.name as brgy,
                        civil_status.name as civil_status')
            ->where('user_id', Auth::user()->id)->get();
        $data['prof_pic'] = UserProfile::where('user_id', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

        return view('admin.profile', $data);
    }




    public function getRecordsData()
    {

        $records = DB::table('seed_samplings')
            ->where('status', 1)
            ->select([
                'id',
                'lab_no',
                'crop',
                'variety',
                'lot_no',
                'no_of_bags',
                'date_harvested',
                'container',
                'moisture_content',
                'physical_purity',
                'germination',
                'fname',
                'mname',
                'lname',
                'ename'
            ]);


        return Datatables::of($records)
            ->addColumn('fullname', function ($records) {
                $name = isset($records->ename) ? $records->fname . ' ' . $records->mname . ' ' . $records->lname . ' ' . $records->ename : $records->fname . ' ' . $records->mname . ' ' . $records->lname;
                return $name;
            })
            ->addColumn('action', function ($records) {
                return '<a href="' . App::make("url")->to("/admin-edit-record/" . $records->id) . '" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> </a>&nbsp;<a id="btn-view" data-id="' . $records->id . '" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> </a>&nbsp;<a href="#" id="btn-del" data-id="' . $records->id . '" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </a>';
            })
            ->make(true);
    }

    public function deleteRecord(Request $request)
    {
        $data = Records::where('id', $request->data)
            ->update(['status' => 0]);

        if ($data) {
            return response()->json([
                'msg'   => "Successfully Deleted!",
                'status' => 200
            ]);
        } else {
            return response()->json([
                'msg'   => "Oops! Something went wrong.",
                'status' => 500
            ]);
        }
    }

    public function getSpecificRecord(Request $request)
    {
        $data = DB::table('records')
            ->join('contact_person', 'records.id', '=', 'contact_person.record_id')
            ->join('civil_status', 'records.civil_status', '=', 'civil_status.id')
            ->join('barangays', 'records.barangay', '=', 'barangays.id')
            ->where('records.id', '=', $request->data)
            ->select('records.*', 'contact_person.*', DB::raw('barangays.name as barangays'), DB::raw('civil_status.name as cs'))
            ->get();

        if ($data) {
            return response()->json([
                'user'  => $data,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 500
            ]);
        }
    }

    public function editRecord($id)
    {
        $data['title'] = "Edit Record";
        $data['records'] = Records::where('id', '=', $id)->get();
        $data['contact_person'] = ContactPerson::where('record_id', '=', $id)->get();
        $data['barangays'] = Barangay::all();
        $data['civil_status'] = CivilStatus::all();
        $data['base_url'] = App::make("url")->to('/');
        $data['prof_pic'] = UserProfile::where('user_id', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

        return view('admin.edit_record', $data);
    }

    public function getSeniorContribution()
    {
        $user_brgy = UserProfile::where('user_id', Auth::user()->id)->select('user_brgy')->pluck('user_brgy');
        $data['title'] = "Senior Citizen Contribution";
        $data['data'] = DB::table('contributions')
            ->join('records', 'contributions.senior_id', '=', 'records.id')
            ->selectRaw("CONCAT(records.fname,' ',records.mname, ' ',records.lname, ' ', CASE WHEN records.ename IS NULL THEN ' ' ELSE records.ename END) as full_name,
                contributions.id,
                contributions.amount,
                contributions.created_at,
                contributions.updated_at,
                records.unique_id_num")
            ->where(['contributions.status' => 1, 'records.barangay' => $user_brgy[0]])
            ->get();
        $data['records'] = Records::where('barangay', $user_brgy[0])->get();
        $data['base_url'] = App::make("url")->to('/');
        $data['prof_pic'] = UserProfile::where('user_id', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

        return view('admin.contributions', $data);
    }

    public function getSeniorPension()
    {
        $user_brgy = UserProfile::where('user_id', Auth::user()->id)->select('user_brgy')->pluck('user_brgy');
        $data['title'] = "Senior Citizen Pension";
        $data['data'] = DB::table('pensions')
            ->join('records', 'pensions.senior_id', '=', 'records.id')
            ->selectRaw("CONCAT(records.fname,' ',records.mname, ' ',records.lname, ' ', CASE WHEN records.ename IS NULL THEN ' ' ELSE records.ename END) as full_name,
                pensions.id,
                pensions.pension_amount,
                pensions.created_at,
                pensions.updated_at,
                records.unique_id_num")
            ->where(['pensions.status' => 1, 'records.barangay' => $user_brgy[0]])
            ->get();
        $data['records'] = Records::where('barangay', $user_brgy[0])->get();
        $data['base_url'] = App::make("url")->to('/');
        $data['prof_pic'] = UserProfile::where('user_id', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

        return view('admin.pensions', $data);
    }

    public function getAdminUsers()
    {
        $data['title'] = "Users";
        $data['data'] = DB::table('users')
            ->join('user_profile', 'users.id', '=', 'user_profile.user_id')
            ->join('barangays', 'user_profile.user_brgy', '=', 'barangays.id')
            ->where('users.status', '=', 1)
            ->selectRaw("users.id,users.name, users.email, users.user_type,users.created_at,users.updated_at,barangays.name as brgy")
            ->get();
        $data['base_url'] = App::make("url")->to('/');
        $data['prof_pic'] = UserProfile::where('user_id', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

        return view('admin.users', $data);
    }

    public function saveContribution(Request $request)
    {
        if (!isset($request->id)) {
            $data = array(
                'senior_id' => $request->senior_id,
                'amount' => $request->amount
            );

            $res = Contribution::create($data);
        } else {
            $data = array(
                'senior_id' => $request->senior_id,
                'amount' => $request->amount
            );

            $res = Contribution::where('id', '=', $request->id)->update($data);
        }

        if ($res) {
            return redirect('/admin-senior-contributions')->with('message', 'success');
        } else {
            return redirect('/admin-senior-contributions')->with('message', 'error');
        }
    }



    public function getAddUser()
    {
        $data['title'] = "Add User";
        $data['base_url'] = App::make("url")->to('/');
        $data['prof_pic'] = UserProfile::where('user_id', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

        return view('admin.add_user', $data);
    }

    public function saveUser(Request $request)
    {
        $this->validate($request, [
            'profile_photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $name = md5(time() . "-" . $request->file('profile_photo')->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');

            if (File::isDirectory($destinationPath)) {
                $image->move($destinationPath, $name);
            } else {
                File::makeDirectory($destinationPath);
                $image->move($destinationPath, $name);
            }
        }

        if (!isset($request->id)) {

            $data = array(
                'name' => ucwords($request->name),
                'email' => $request->email,
                'user_type' => $request->user_type,
                'password' => Hash::make('password')
            );

            $user_id = User::create($data);

            $data_cp = array(
                'user_id' => $user_id->id,
                'user_profile_pic' => !empty($name) ? $name : '',
                'user_birthdate' => date('Y-m-d', strtotime($request->birthdate)),
                'user_civil_status' => $request->civil_status,
                'user_gender' => $request->gender,
                'user_address' => ucwords($request->address),
                'user_street' => ucwords($request->street),
                'user_brgy' => ucwords($request->brgy),
                'user_mobile_num' => $request->mobile_num,
                'user_phone_num' => $request->phone_num,
            );

            $resultData = UserProfile::create($data_cp);
        } else {
            $data = array(
                'name' => ucwords($request->name),
                'email' => $request->email,
                'user_type' => $request->user_type,
            );

            $user_id = User::where('id', '=', $request->id)->update($data);

            $data_cp = array(
                'user_id' => $request->up_id,
                'user_profile_pic' => !empty($name) ? $name : '',
                'user_birthdate' => date('Y-m-d', strtotime($request->birthdate)),
                'user_civil_status' => $request->civil_status,
                'user_gender' => $request->gender,
                'user_address' => ucwords($request->address),
                'user_street' => ucwords($request->street),
                'user_brgy' => ucwords($request->brgy),
                'user_mobile_num' => $request->mobile_num,
                'user_phone_num' => $request->phone_num,
            );

            $resultData = UserProfile::where('id', '=', $request->up_id)->update($data_cp);
        }

        if ($resultData) {
            return redirect('/admin-users')->with('message', 'success');
        } else {
            return redirect('/admin-users')->with('message', 'error');
        }
    }

    public function changePassword(Request $request)
    {
        $data = User::where('id', '=', $request->data)->update(['password' => Hash::make('password')]);

        if ($data) {
            return response()->json([
                'msg'   => "Successfully Changed!",
                'status' => 200
            ]);
        } else {
            return response()->json([
                'msg'   => "Oops! Something went wrong.",
                'status' => 500
            ]);
        }
    }

    public function deleteUser(Request $request)
    {
        $data = User::where('id', $request->data)->update(['status' => 0]);

        if ($data) {
            return response()->json([
                'msg'   => "Successfully Deleted!",
                'status' => 200
            ]);
        } else {
            return response()->json([
                'msg'   => "Oops! Something went wrong.",
                'status' => 500
            ]);
        }
    }

    public function editUser($id)
    {
        $data['title'] = "Edit User";
        $data['user'] = DB::table('users')
            ->join('user_profile', 'users.id', '=', 'user_profile.user_id')
            ->where('users.id', '=', $id)
            ->get();
        $data['barangays'] = Barangay::all();
        $data['civil_status'] = CivilStatus::all();
        $data['base_url'] = App::make("url")->to('/');
        $data['prof_pic'] = UserProfile::where('user_id', Auth::user()->id)->select('user_profile_pic')->pluck('user_profile_pic');

        return view('admin.add_user', $data);
    }

    public function changeUserPassword(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            if (strcmp($request->new_password, $request->confirm_new_password) == 0) {
                $data = User::where('id', '=', Auth::user()->id)->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->new_password)
                ]);

                if ($data) {
                    return redirect()->back()->with('message', 'Successfully Save.');
                } else {
                    return redirect()->back()->with('message', 'Something went wrong.');
                }
            } else {
                return redirect()->back()->with('message', 'Password and Confirm password did not match!');
            }
        } else {
            return redirect()->back()->with('message', 'Please enter the correct old password');
        }
    }

    public function seedSampling(){
        $data['title'] = "Seed Sampling";
        $data['base_url'] = App::make("url")->to('/');


        return view('admin.seed_sampling', $data);
    }

    public function saveSeedSampling(Request $request)
    {
        if (!isset($request->id)) {
            $data = array(
                'request_no' => $request->request_no,
                'lab_no' => $request->lab_no,
                'crop' => $request->crop,
                'variety' => $request->variety,
                'source' => $request->source,
                'lot_no' => $request->lot_no,
                'weight_of_seed_lot' => $request->weight_of_seed_lot,
                'no_of_bags' => $request->no_of_bags,
                'date_harvested' => $request->date_harvested,
                'container' => $request->container,
                'date_of_application' => $request->date_of_application,
                'moisture_content' => $request->moisture_content,
                'physical_purity' => $request->physical_purity,
                'germination' => $request->germination,
                'varietal_purity' => $request->varietal_purity,
                'germination' => $request->germination,
                'seed_health' => $request->seed_health,
                'germination' => $request->germination,
                'ttc' => $request->ttc,
                'others' => $request->others,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'ename' => $request->ename,
                'name_of_company' => $request->name_of_company,
                'address' => $request->address,
                'purpose' => $request->purpose,
                'remarks' => $request->remarks
            );

            $res = SeedSampling::create($data);
        } else {
            $data = array(
                'request_no' => $request->request_no,
                'lab_no' => $request->lab_no,
                'crop' => $request->crop,
                'variety' => $request->variety,
                'source' => $request->source,
                'lot_no' => $request->lot_no,
                'weight_of_seed_lot' => $request->weight_of_seed_lot,
                'no_of_bags' => $request->no_of_bags,
                'date_harvested' => $request->date_harvested,
                'container' => $request->container,
                'date_of_application' => $request->date_of_application,
                'moisture_content' => $request->moisture_content,
                'physical_purity' => $request->physical_purity,
                'germination' => $request->germination,
                'varietal_purity' => $request->varietal_purity,
                'germination' => $request->germination,
                'seed_health' => $request->seed_health,
                'germination' => $request->germination,
                'ttc' => $request->ttc,
                'others' => $request->others,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'ename' => $request->ename,
                'name_of_company' => $request->name_of_company,
                'address' => $request->address,
                'purpose' => $request->purpose,
                'remarks' => $request->remarks
            );

            $res = SeedSampling::where('id', '=', $request->id)->update($data);
        }

        if ($res) {
            return redirect('/admin-seed-sampling')->with('message', 'success');
        } else {
            return redirect('/admin-seed-sampling')->with('message', 'error');
        }
    }

    // public function saveSeedSampling(Request $request){
    //     $data = array{
    //         'request_no' => $request->request_no,
    //         'crop' => $request->crop,
    //         'variety' => $request->variety,
    //         'source' => $request->source,
    //         'lot_no' => $request->lot_no,
    //         'weight_of_seed_lot' => $request->weight_of_seed_lot,
    //         'no_of_bags' => $request->no_of_bags,
    //         'date_harvested' => $request->date_harvested,
    //         'container' => $request->container,
    //         'date_of_application' => $request->date_of_application,
    //         'moisture_content' => $request->moisture_content,
    //         'physical_purity' => $request->physical_purity,
    //         'germination' => $request->germination,
    //         'varietal_purity' => $request->varietal_purity,
    //         'seed_health' => $request->seed_health,
    //         'ttc' => $request->ttc,
    //         'others' => $request->others,
    //         'fname' => $request->fname,
    //         'mname' => $request->mname,
    //         'lname' => $request->lname,
    //         'ename' => $request->ename,
    //         'name_of_company' => $request->name_of_company,
    //         'address' => $request->address,
    //         'purpose' => $request->purpose,
    //         'remarks' => $request->remarks,
    //         'created_by' => Auth::user()->name,
    //         'updated_by' => isset($request->id) ? Auth::user()->name : NULL,
    //         'status' => 1
    //     };
    //     $res = SeedSampling::updateOrCreate{['id' => $request->id], $data};

    //     if($res){
    //         return redirect('/admin-seed-sampling')->with('message','success');
    //     } else {
    //         return redirect()->back()->with('message','error');
    //     }
    // }
}
