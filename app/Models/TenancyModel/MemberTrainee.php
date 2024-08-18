<?php

namespace App\Models\TenancyModel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MemberTrainee extends Model
{
    use HasFactory, HasUuids;
    protected $table = "member_trainees";
    public $timestamps = false;
    public $appends = ["invoice_photo_url", "expired_date_format", "start_date_format", "created_at_date_format"];

    protected $fillable = [
        "invoice_id",
        "user_id",
        "membership_id",
        "membership_start_date",
        "membership_expired_date",
        "fitness_goal",
        "total",
        "tax",
        "file_invoice_upload",
        "membership_status",
        "transaction_status",
        "created_at",
        "updated_at"
    ];

    //Accessors
    public function getInvoicePhotoUrlAttribute()
    {
        $path_photo_invoice = "tenant-" . tenant("id") . "/assets/images/member-invoice/";
        return Storage::url($path_photo_invoice . $this->attributes['file_invoice_upload']);
    }

    public function getCreatedAtDateFormatAttribute()
    {
        return $this->attributes['created_at'] ? Carbon::parse($this->attributes["created_at"])->format("d M Y, H:i") : "-";
    }

    public function getExpiredDateFormatAttribute()
    {
        return $this->attributes['membership_expired_date'] ? Carbon::parse($this->attributes["membership_expired_date"])->format("d M Y, H:i") : "-";
    }
    public function getStartDateFormatAttribute()
    {
        return $this->attributes['membership_start_date'] ? Carbon::parse($this->attributes["membership_start_date"])->format("d M Y, H:i") : "-";
    }

    // Relations
    public function MembershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, "membership_id", "id");
    }

    public function User()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
