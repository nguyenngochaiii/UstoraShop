<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;
class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::paginate(12);

        return view('admin.notifications.index',compact('notifications'));
    }

    public function getNotificationsData(Request $request){
        // For the sake of simplicity, assume we have a variable called
        // $notifications with the unread notifications. Each notification
        // have the next properties:
        // icon: An icon for the notification.
        // text: A text for the notification.
        // time: The time since notification was created on the server.
        // At next, we define a hardcoded variable with the explained format,
        // but you can assume this data comes from a database query.

        $messages = Notification::where('read','0')->get();
        
        $notifications = [];

        foreach ($messages as $message) {
            $notifications[] = [
                'icon' => 'fas fa-fw fa-user text-primary',
                'text' => $message->content,
                'order_id' => $message->order_id, 
            ];
        }

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";

            // $time = "<span class='float-right text-muted text-sm'>
            //         {$not['time']}
            //         </span>";
            //
            $dropdownHtml .= "<a href='" . route('admin.orders.show', $not['order_id'] ) . " ' class='dropdown-item'>
                                {$icon}{$not['text']}
                            </a>";

            // $dropdownHtml .= "<a href='#' class='dropdown-item'>
            //     {$icon}{$not['text']}{$time}
            // </a>";
            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.

        return [
            'label'       => count($notifications),
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];
    }
}