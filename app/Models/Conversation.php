<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }
    
    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Conversation.php

    public function updateLastRead($userId)
    {
        $this->update([
            'last_read_user1' => $this->user1_id == $userId ? now() : $this->last_read_user1,
            'last_read_user2' => $this->user2_id == $userId ? now() : $this->last_read_user2,
        ]);
    }

    public function hasUnreadMessages($userId)
    {
        $lastReadColumn = $this->user1_id == $userId ? 'last_read_user1' : 'last_read_user2';
        
        return $this->messages()
            ->where('created_at', '>', $this->{$lastReadColumn})
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->exists();
    }

    

    
}
