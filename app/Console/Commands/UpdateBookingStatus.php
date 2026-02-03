<?php

   namespace App\Console\Commands;

   use Illuminate\Console\Command;
   use App\Models\bookings;

   class UpdateBookingStatus extends Command
   {
       protected $signature = 'booking:update-status';
       protected $description = 'Update status booking yang sudah lewat';

       public function handle()
       {
           $updatedCount = bookings::where(function ($query) {
               $query->where('tanggal', '<', now()->toDateString())
                     ->orWhere(function ($q) {
                         $q->where('tanggal', now()->toDateString())
                           ->where('jam_selesai', '<', now()->format('H:i'));
                     });
           })
           ->where('status', '!=', 'Selesai')
           ->update(['status' => 'Selesai']);

           $this->info("Jumlah booking yang diperbarui: " . $updatedCount);
       }
   }
   