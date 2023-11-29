<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use App\Models\FeeShip;

class DeliveryController extends Controller
{
    public function manage_delivery(Request $request){
        $city = City::orderBy('matp', 'ASC')->get();
        return view('admin.delivery.magage_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == "city"){
                $select_district = District::where('matp', $data['ma_tp'])->orderBy('maqh', 'ASC')->get();
                $output.=
                    '<option>Chọn quận/huyện</option>';
                foreach($select_district as $k => $district){
                $output.='<option value = "'.$district->maqh.'">'.$district->district_name.'</option>';
                }
            }else{
                $select_ward= Ward::where('maqh', $data['ma_tp'])->orderBy('xaid', 'ASC')->get();
                $output.=
                    '<option>Chọn xã/phường</option>';
                foreach($select_ward as $k => $ward){
                $output.='<option value = "'.$ward->xaid.'">'.$ward->ward_name.'</option>';
                }
            }
        }
        echo $output;
    }
    public function add_delivery(Request $request){
        $data = $request->all();
        $feeship = new FeeShip();
        $feeship->fee_id_city = $data['city'];
        $feeship->fee_id_district = $data['district'];
        $feeship->fee_id_ward = $data['ward'];
        $feeship->fee_ship = $data['feeship'];
        $feeship->save();

    }
    public function load_delivery(){
        $feeship = FeeShip::orderBy('fee_id', 'DESC')->get();
        $output = '';
        $output .= '
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thread>
                                <tr style="background-color:rgb(151, 151, 214);">
                                    <th>Tên thành phố</th>
                                    <th>Tên quận/huyện</th>
                                    <th>Tên xã/phường</th>
                                    <th>Phí vận chuyển</th>
                                </tr>
                            </thread>
                            <tbody>
                ';
                        foreach($feeship as $k =>$fee){
        $output .= '
                                <tr>
                                    <td>'.$fee->city->city_name.'</td>
                                    <td>'.$fee->district->district_name.'</td>
                                    <td>'.$fee->ward->ward_name.'</td>
                                    <td contenteditable data-feeship_id = "'.$fee->fee_id.'"
                                        class="feeship_edit">
                                        '.number_format($fee->fee_ship,0,',','.').'
                                    </td>
                                </tr>
                ';
                            }
        $output .= '       </tbody>
                        </table>
                    </div>
                ';
        echo $output;
    }
    public function update_fee(Request $request){
        $data = $request->all();
        $feeship = FeeShip::find($data['feeship_id']);
        $fee = rtrim($data['fee'], '.');
        $feeship->fee_ship = $fee;
        $feeship->save();
    }
}
