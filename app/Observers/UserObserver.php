<?php

namespace App\Observers;

use App\Models\Personnel;
use Filament\Notifications\Notification;

use App\Models\User;
use Filament\Notifications\Actions\Action; // Correct Action import
use Illuminate\Support\Facades\Auth;
use App\Filament\Admin\Resources\UserResource;

class UserObserver
{
    protected static string $resource = UserResource::class;

    /**
     * Handle the Employee "created" event.
     */
    public function created(User $user): void
    {
        self::saveData($user);

        // Retrieve the current record
        $record = $user;
      //  $user = auth()->user();

        // Retrieve all users with the admin role
        $adminRecipients = User::whereHas('roles', function($query) {
            $query->where('name', 'Admin');
        })->get();

        // Loop through each admin recipient and send the notification
        foreach ($adminRecipients as $recipient) {
            Notification::make()
                ->title('User Record Created')
                ->icon('heroicon-o-document-text')
                ->body(
                    "**Created: " .
                    "{$record->name}, **\n" .
                    "This record was created by " . Auth::check() ? Auth::user()->name : $user->name . "."
                )
                ->actions([
                    Action::make('View')
                        ->url(UserResource::getUrl('edit', ['record' => $record->id])),
                ])
                
                ->sendToDatabase($recipient);
        }

    }

    /**
     * Handle the Employee "updated" event.
     */



    public function updated(User $user) : void
    {
  

        self::saveData($user);

        $record = $user;
       // $user = auth()->user();
    
        // Retrieve all users with the admin role
        $adminRecipients = User::whereHas('roles', function($query) {
            $query->where('name', 'Admin');
        })->get();
    
        // Loop through each admin recipient and send the notification
        foreach ($adminRecipients as $recipient) {
            Notification::make()
                ->title('User Record Updated')
                ->icon('heroicon-o-document-text')
                ->body(
                    "**Update: " . 
                    "{$record->name}, **\n" .
                    "This record was updated by " . Auth::user()->name . "."
                )
                // // ->actions([
                // //     Action::make('View')
                // //         ->url(UserResource::getUrl('edit', ['record' => $record->id])),
                // ])
                
                ->sendToDatabase($recipient);
        }
    

        
    }

    public function saveData($user) {

        // if ($user->monitoring_tool_id) {

        //     // Find the monitoring tool associated with the employee's registry ID
        //     $monitoring_tool = MonitoringTool::find($user->monitoring_tool_id);

        //     if(empty($user->national_health_facility_registries_id)){
        //         $update = Employee::find($user->id);
        //         $update->national_health_facility_registries_id = $monitoring_tool->facility_code;
        //         $update->save();
        //     }else{

        //         $monitoring_tool = MonitoringTool::where('facility_code',$user->national_health_facility_registries_id)->first();

        //         if($monitoring_tool){

        //             $update = Employee::find($user->id);
        //             $update->monitoring_tool_id = $monitoring_tool->id;
        //             $update->save();
    

        //         }
               
              
    
        //     }

        //     if($monitoring_tool){
        
        //         $relationshipExists = StaffToolRelationship::where('staff_id', $user->id)->exists();
                
        //         // Create or update the relationship between the employee and the found monitoring tool
        //         if ($relationshipExists) {
        //             StaffToolRelationship::where('staff_id', $user->id)->update([
        //                 'monitoring_tool_id' => $monitoring_tool->id,
        //                 'status' => 1,
        //             ]);
        //         } else {
        //             StaffToolRelationship::create([
        //                 'staff_id' => $user->id,
        //                 'monitoring_tool_id' => $monitoring_tool->id,
        //                 'status' => 1,
        //             ]);
        //         } 
        //     }
            
        // } 

       
    }


    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(User $user): void
    {

        $record = $user;
       // $user = auth()->user();
    
        // Retrieve all users with the admin role
        $adminRecipients = User::whereHas('roles', function($query) {
            $query->where('name', 'Admin');
        })->get();
    
        // Loop through each admin recipient and send the notification
        foreach ($adminRecipients as $recipient) {
            Notification::make()
            ->title('User Record Deleted')
                ->icon('heroicon-o-document-text')
                ->body(
                    "**Deleted: " . 
                    "{$record->name}, **\n" .
                    "This record was deleted by " . Auth::user()->name . "."
                )
                ->actions([
                   
                ])
                
                ->sendToDatabase($recipient);
        }
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Personnel $user): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Personnel $user): void
    {
        //
    }
}
