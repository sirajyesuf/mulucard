<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Mail\LandingContactUsMail;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\ContactUs;
use App\Models\Feature;
use App\Models\FrontFAQs;
use App\Models\FrontTestimonial;
use App\Models\Meta;
use App\Models\Plan;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        // $testimonials = FrontTestimonial::with('media')->get();
        // $faqs =  FrontFAQs::first();
        // $metas = Meta::first();

        // if (! empty($metas)) {
        //     $metas = $metas->toArray();
        // }

        // $setting = Setting::pluck('value', 'key')->toArray();

        // $aboutUS = AboutUs::with('media')->get()->toArray();

        // $features = Feature::all();

        // $plans = Plan::with(['currency', 'planFeature', 'hasZeroPlan', 'planCustomFields'])->whereIsDefault(Plan::IS_DEACTIVE)->whereStatus(Plan::IS_ACTIVE)->get();

        // $homePage = getSuperAdminSettingValue('home_page_theme') == 1 ? 'home' : 'home1';
        // $view = getSuperAdminSettingValue('is_front_page') ? view("front.home.$homePage", compact('plans', 'setting', 'features', 'testimonials', 'aboutUS', 'metas', 'faqs')) : redirect(route('login'));

        $features = [[
        "title" => "NFC Technology Integration",
        "description" => "Share contact details instantly by tapping an NFC-enabled card or device on a smartphone.",
        "icon" => "nfc",
    ],
    [
        "title" => "QR Code Integration",
        "description" => "Generate a unique QR code for your digital card that can be scanned by anyone with a smartphone.",
        "icon" => "qr-code",
    ],
    [
        "title" => "Social Media Integration",
        "description" => "Link all your social media profiles to your digital card for a complete online presence.",
        "icon" => "globe",
    ],
    [
        "title" => "Team and Enterprise Features",
        "description" => "Create and manage digital cards for your entire team or organization with admin controls.",
        "icon" => "briefcase",
    ],
    [
        "title" => "Offline Sharing",
        "description" => "Allow users to save your card to their phone contacts.",
        "icon" => "download",
    ],
    [
        "title" => "Real-Time Updates",
        "description" => "Update your job title, phone number, or address in real-time without reissuing cards.",
        "icon" => "refresh-cw",
    ]];

    $plans = [
        [
            "name" => "Standard",
            "price" => "ETB 999 / year",
            "description" => "Ideal for individuals seeking a professional digital presence with essential features.",
            "features" => [
                "1 digital card",
                "Multiple template choices",
                "Up to 5 services",
                "Up to 5 galleries",
                "Personalized link",
            ],
        ],
        [
            "name" => "Premium",
            "price" => "ETB 2000 / year",
            "description" => "Perfect for professionals and small businesses needing advanced networking tools.",
            "features" => [
                "Unlimited digital cards",
                "Multiple template choices",
                "Advanced sharing options",
                "Analytics dashboard",
                "Up to 5 services",
                "Up to 5 galleries",
                "Personalized link",
                "Dedicated 'Contact Us' section",
            ],
        ],
    ];

        return view('front.home.landingpage',compact('features','plans'));
    }

    public function store(CreateContactRequest $request)
    {
        $input = $request->all();
        $user = getSuperAdminEmail();

        ContactUs::create($input);
        Mail::to($user)
            ->send(new LandingContactUsMail(
                $input,
                __('messages.placeholder.message_sent')
            ));

        return $this->sendSuccess(__('messages.placeholder.message_sent'));
    }

    /**
     * @return Application|Factory|View
     */
    public function showContactUs(): \Illuminate\View\View
    {
        return view('sadmin.contactus.index');
    }

    public function destroyContactUs(ContactUs $enquiry): JsonResponse
    {
        $enquiry->delete();
        return $this->sendSuccess(__('messages.flash.enquiry_delete'));
    }

    public function themeConfiguration(): \Illuminate\View\View
    {
        $setting = Setting::all()->pluck('value', 'key');

        $view = view('settings.theme_config.index', compact('setting'));

        return $view;
    }

    public function changeLanguage(Request $request): RedirectResponse
    {
        Session::put('languageName', $request->input('languageName'));

        return redirect()->back();
    }


    public function banner(Request $request): \Illuminate\View\View
    {
        $setting = Setting::all()->pluck('value', 'key');

        return view('sadmin.supportBanner.index', compact('setting'));
    }
    public function appDownload(Request $request): \Illuminate\View\View
    {
        $setting = Setting::all()->pluck('value', 'key');

        return view('sadmin.supportMobile.index', compact('setting'));
    }

    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function termCondition()
    {
        $setting = Setting::all()->pluck('value', 'key');
        $faqs =  FrontFAQs::first();

        $view = view('front.terms_conditions', compact('setting', 'faqs'));

        return $view;
    }

    /**
     * @return Application|Factory|View
     */
    public function privacyPolicy(): \Illuminate\View\View
    {
        $setting = Setting::all()->pluck('value', 'key');
        $faqs =  FrontFAQs::first();

        return view('front.privacy_policy', compact('setting', 'faqs'));
    }

    public function declineCookie()
    {
        session(['declined' => 1]);
    }

    public function vcardTemplates()
    {

        $setting = Setting::pluck('value', 'key')->toArray();
        $faqs =  FrontFAQs::first();
        return view('front.home.vcards-templates', compact('setting', 'faqs'));
    }

    public function forntFaq()
    {

        $setting = Setting::pluck('value', 'key')->toArray();
        $blogs = Blog::where('status', '1')->get();
        $faq = FrontFAQs::all();
        $faqs =  FrontFAQs::first();
        if (getSuperAdminSettingValue('home_page_theme') == 2) {
            return view('front.home.home-faq1', compact('setting', 'faq', 'faqs', 'blogs'));
        } else {
            return view('front.home.home-faq', compact('setting', 'faq', 'faqs', 'blogs'));
        }
    }

    public function ForntBlog()
    {
        $setting = Setting::pluck('value', 'key')->toArray();
        $blogs = Blog::where('status', '1')->get();
        $faqs =  FrontFAQs::first();
        if (getSuperAdminSettingValue('home_page_theme') == 2) {
            return view('front.home.home-blog1', compact('blogs', 'faqs', 'setting'));
        } else {
            return view('front.home.home-blog', compact('blogs', 'faqs', 'setting'));
        }
    }

    public function ForntBlogShow($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $faqs =  FrontFAQs::first();
        $setting = Setting::pluck('value', 'key')->toArray();

        if (!$blog->status) {
            abort(404);
        }

        if (getSuperAdminSettingValue('home_page_theme') == 2) {
            return view('front.home.home-blog-show1', compact('blog', 'faqs', 'setting'));
        } else {
            return view('front.home.home-blog-show', compact('blog', 'faqs', 'setting'));
        }
    }
}
