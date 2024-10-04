<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name', 'email'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // user memiliki banyak courses
    // pada model course berada di pivotable course_students
    public function courses(){
        return $this->belongsToMany(Course::class, 'course_students');
    }

    // satu pengguna dapat langganan berkali-kali
    public function subscribe_transactions(){
        return $this->hasMany(SubscribeTransaction::class);
    }

    // check, langganan terakhirnya masih active atau tidaa
    // case: dia sudah bayar atau belum, diambil dari data updated_at satu saja yang paling terakhir (first).
    public function hasActiveSubscription(){
        $latestSubscription = $this->subscribe_transactions()
        ->where('is_paid', true)
        ->latest('updated_at')
        ->first();

        if (!$latestSubscription) {
            return false;
        }

        // dicheck apakah dia masih aktif atau tidak setelah 30 hari
        $subscriptionEndDate = Carbon::parse($latestSubscription->subscription_start_date)->addMonths(1);
        return Carbon::now()->lessThanOrEqualTo($subscriptionEndDate); // true == dia berlangganan
    }
}
