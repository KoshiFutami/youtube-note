<?php

namespace App\Models;

use Illuminate\Http\File;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Image;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'introduction',
        'thumbnail',
        'password',
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

    /**
     * プロフィール画像を保存
     */
    public static function storeProfileThumbnail($thumnail_file, $user_id)
    {
        $img = Image::make($thumnail_file);

        $img->fit(320, 320, function ($constraint) {
            $constraint->upsize();
        });

        if (app()->isLocal()) {
            $file_name = 'user_thumbnail_' . $user_id . '.jpg';
            $save_path = 'public/image/' . $file_name;
            Storage::put($save_path, (string) $img->encode('jpg'));
            $thumbnail_path = Storage::url($save_path);

        } else {
    

            // S3にアップロード
            $s3_path = Storage::disk('s3')->put('/upload/', $img->encode(), 'public');
            $thumbnail_path = Storage::disk('s3')->url($s3_path);

            // $file_name = 'user_thumbnail_' . $user_id . '.jpg';

            // // ローカルに一時的に保存
            // $tmp_path = storage_path('public/tmp/') . $file_name;
            // // $img->save($tmp_path);
            // Storage::put($tmp_path, (string) $img->encode('jpg'));

            // // ローカルに一時的に保存した画像をS3にアップロード
            // $s3_path = Storage::disk('s3')->putFileAs('/', new File($tmp_path), 'upload/' . $file_name, 'public');
            // $thumbnail_path = Storage::disk('s3')->url($s3_path);

            // ローカルに一時的に保存した画像を削除
            // Storage::disk('local')->delete('tmp/' . $file_name);
        }

        return $thumbnail_path;
    }
}
