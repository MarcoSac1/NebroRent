<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        "cv",
        "photo",
        "address",
        "telephone_number",
        "service",
        "visible",
        "is_premium"
    ];

    // relation with users_table
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relation with specializations_table
    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(Specialization::class);
    }

    // relation with sponsors_table
    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class)
            ->withPivot('sponsorship_time')
            ->withPivot('expiration_date')
            ->withTimestamps();
    }

    // relation with votes_table
    public function votes(): BelongsToMany
    {
        return $this->belongsToMany(Vote::class, 'profile_vote', 'profile_id', 'vote_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function checkAndUpdatePremiumStatus()
    {
        $existingSponsorship = $this->sponsors()->orderBy('pivot_expiration_date', 'desc')->first();
        if ($existingSponsorship === null || Carbon::now()->gt($existingSponsorship->pivot->expiration_date)) {
            // Nessuna sponsorizzazione attiva o scaduta
            $this->is_premium = false;
        } else {
            // Sponsorizzazione attiva
            $this->is_premium = true;
        }

        // Salva il cambiamento nel database
        $this->save();
    }
}
