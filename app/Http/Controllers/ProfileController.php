<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $title = "Profile Update";
        $generalSettings = GeneralSetting::getItem();
        return view('profile.edit', [
            'user' => $request->user(),
            'title' => $title,
            'generalSettings' => $generalSettings
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateIcons(Request $request){
        $generalSettings = GeneralSetting::getItem();

        $icon = '';
        if($generalSettings->icon){
            $icon = $generalSettings->icon;
        }
        if($request->hasFile('icon')){
            $this->batchDelete($icon, public_path('uploads/images/general/icons/'));
            $icon = $this->imageUploadKeepOriginalName(file: $request->icon, full_path: public_path("uploads/images/general/icons"), only_name: true);
        }

        $favicon = '';
        if($generalSettings->favicon){
            $favicon = $generalSettings->favicon;
        }
        if($request->hasFile('favicon')){
            $this->batchDelete($favicon, public_path('uploads/images/general/icons/'));
            $favicon = $this->imageUploadKeepOriginalName(file: $request->favicon, full_path: public_path("uploads/images/general/icons"), only_name: true);
        }
        $generalSettings->icon = $icon;
        $generalSettings->favicon = $favicon;
        $generalSettings->save();
        Alert::toast('Icons Update','success');
        return redirect()->route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
