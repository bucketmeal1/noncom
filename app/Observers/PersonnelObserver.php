<?php

namespace App\Observers;

use App\Models\Personnel;
use Filament\Notifications\Notification;

use App\Models\User;
use Filament\Notifications\Actions\Action; // Correct Action import
use Illuminate\Support\Facades\Auth;
use App\Filament\Admin\Resources\PersonnelResource;

class PersonnelObserver
{
    protected static string $resource = PersonnelResource::class;

    /**
     * Handle the Employee "created" event.
     */
    public function created(Personnel $personnel): void
    {
        self::saveData($personnel);

        // Retrieve the current record
        $record = $personnel;
        $user = auth()->user();

        // Retrieve all users with the admin role
        $adminRecipients = User::whereHas('roles', function($query) {
            $query->where('name', 'Admin');
        })->get();

        // Loop through each admin recipient and send the notification
        foreach ($adminRecipients as $recipient) {
            Notification::make()
                ->title('Personnel Record Created')
                ->icon('heroicon-o-document-text')
                ->body(
                    "**Created: " . $user->facility_name . 
                    " - {$record->personnel_lname}, {$record->personnel_fname} {$record->personnel_mname}**\n" .
                    "This record was created by " . Auth::user()->name . "."
                )
                ->actions([
                    Action::make('View')
                        ->url(PersonnelResource::getUrl('edit', ['record' => $record->id])),
                ])
                
                ->sendToDatabase($recipient);
        }

    }

    /**
     * Handle the Employee "updated" event.
     */



    public function updated(Personnel $personnel) : void
    {
  

        self::saveData($personnel);

        $record = $personnel;
        $user = auth()->user();
    
        // Retrieve all users with the admin role
        $adminRecipients = User::whereHas('roles', function($query) {
            $query->where('name', 'Admin');
        })->get();
    
        // Loop through each admin recipient and send the notification
        foreach ($adminRecipients as $recipient) {
            Notification::make()
                ->title('Personnel Record Updated')
                ->icon('heroicon-o-document-text')
                ->body(
                    "**Update: " . $user->facility_name . 
                    " - {$record->personnel_lname}, {$record->personnel_fname} {$record->personnel_mname}**\n" .
                    "This record was updated by " . Auth::user()->name . "."
                )
                ->actions([
                    Action::make('View')
                        ->url(PersonnelResource::getUrl('edit', ['record' => $record->id])),
                ])
                
                ->sendToDatabase($recipient);
        }
    

        
    }

    public function saveData($personnel) {

        // if ($personnel->monitoring_tool_id) {

        //     // Find the monitoring tool associated with the employee's registry ID
        //     $monitoring_tool = MonitoringTool::find($personnel->monitoring_tool_id);

        //     if(empty($personnel->national_health_facility_registries_id)){
        //         $update = Employee::find($personnel->id);
        //         $update->national_health_facility_registries_id = $monitoring_tool->facility_code;
        //         $update->save();
        //     }else{

        //         $monitoring_tool = MonitoringTool::where('facility_code',$personnel->national_health_facility_registries_id)->first();

        //         if($monitoring_tool){

        //             $update = Employee::find($personnel->id);
        //             $update->monitoring_tool_id = $monitoring_tool->id;
        //             $update->save();
    

        //         }
               
              
    
        //     }

        //     if($monitoring_tool){
        
        //         $relationshipExists = StaffToolRelationship::where('staff_id', $personnel->id)->exists();
                
        //         // Create or update the relationship between the employee and the found monitoring tool
        //         if ($relationshipExists) {
        //             StaffToolRelationship::where('staff_id', $personnel->id)->update([
        //                 'monitoring_tool_id' => $monitoring_tool->id,
        //                 'status' => 1,
        //             ]);
        //         } else {
        //             StaffToolRelationship::create([
        //                 'staff_id' => $personnel->id,
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
    public function deleted(Personnel $personnel): void
    {

        $record = $personnel;
        $user = auth()->user();
    
        // Retrieve all users with the admin role
        $adminRecipients = User::whereHas('roles', function($query) {
            $query->where('name', 'Admin');
        })->get();
    
        // Loop through each admin recipient and send the notification
        foreach ($adminRecipients as $recipient) {
            Notification::make()
            ->title('Personnel Record Deleted')
                ->icon('heroicon-o-document-text')
                ->body(
                    "**Deleted: " . $user->facility_name . 
                    " - {$record->personnel_lname}, {$record->personnel_fname} {$record->personnel_mname}**\n" .
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
    public function restored(Personnel $personnel): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Personnel $personnel): void
    {
        //
    }
}
