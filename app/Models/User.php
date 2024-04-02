<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'address',
        'status',
        'affiliate_code',
        'referred_by',
        'commission',
        'image',
        'last_reply_seen_at',
        'active_status',
        'waive_fees',
        'avatar',
        'dark_mode',
        'social_id',
        'social_provider',
        'social_token',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function attendances()
  {
    return $this->hasMany(Attendance::class);
  }
  // User model
  // Define the relationship to Earnings (User has many Earnings)
  public function earnings()
  {
      return $this->hasMany(Earning::class, 'user_id', 'id');
  }

  // Define the relationship to Transections (User has many Transections)
  public function transections()
  {
      return $this->hasMany(Transection::class, 'user_id', 'id');
  }

  // Define the relationship to Transfers as a sender (User has many Transfers as a sender)
  public function transfersAsSender()
  {
      return $this->hasMany(Transfer::class, 'sender_user_id', 'id');
  }

  // Define the relationship to Transfers as a receiver (User has many Transfers as a receiver)
  public function transfersAsReceiver()
  {
      return $this->hasMany(Transfer::class, 'receiver_user_id', 'id');
  }
  public function supportTickets()
  {
      return $this->hasMany(SupportTicket::class);
  }

  public function ticketReplies()
  {
      return $this->hasMany(TicketReply::class);
  }

  public function balance()
  {
      return $this->hasOne(UserBalance::class);
  }

  public function deposits()
  {
      return $this->hasMany(Deposit::class, 'deposited_from');
  }
  public function referredBy()
 {
    return $this->belongsTo(User::class, 'referred_by');
 }
 
 public function conversations()
 {
     return $this->hasMany(Conversation::class, 'user1_id', 'id')
         ->orWhere('user2_id', $this->id);
 }

 public function messages()
 {
     return $this->hasMany(Message::class, 'sender_id', 'id');
 }

 public function senderMessages()
 {
     return $this->hasMany(ChMessage::class, 'from_id', 'id');
 }

 public function reviews()
{
    return $this->hasMany(Review::class);
}
public function promoCodeUsages()
{
    return $this->hasMany(PromoCodeUsage::class, 'user_id');
}

public function tourBookings()
{
    return $this->hasMany(TourBooking::class);
}


}
