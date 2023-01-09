<?php

use App\Models\DepartmentList;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\FaqComponent;
use App\Http\Livewire\Admin\BlogComponent;
use App\Http\Livewire\Admin\NewsComponent;
use App\Http\Livewire\Admin\TeamComponent;
use App\Http\Livewire\Pages\HomeComponent;
use App\Http\Livewire\Admin\AboutComponent;
use App\Http\Livewire\Admin\LogosComponent;
use App\Http\Livewire\Admin\AddFaqComponent;
use App\Http\Livewire\Admin\BeforeComponent;
use App\Http\Livewire\Admin\AddBlogComponent;
use App\Http\Livewire\Admin\AddNewsComponent;
use App\Http\Livewire\Admin\AddTeamComponent;
use App\Http\Livewire\Admin\ContactComponent;
use App\Http\Livewire\Admin\EditFaqComponent;
use App\Http\Livewire\Admin\FeatureComponent;
use App\Http\Livewire\Admin\FunFactComponent;
use App\Http\Livewire\Admin\GalleryComponent;
use App\Http\Livewire\Admin\AddAboutComponent;
use App\Http\Livewire\Admin\AddLogosComponent;
use App\Http\Livewire\Admin\CategoryComponent;
use App\Http\Livewire\Admin\EditBlogComponent;
use App\Http\Livewire\Admin\EditNewsComponent;
use App\Http\Livewire\Admin\EditTeamComponent;
use App\Http\Livewire\Admin\AddBeforeComponent;
use App\Http\Livewire\Admin\EditAboutComponent;
use App\Http\Livewire\Admin\EditLogosComponent;
use Illuminate\Foundation\Console\AboutCommand;
use App\Http\Livewire\Admin\AddContactComponent;
use App\Http\Livewire\Admin\AddFeatureComponent;
use App\Http\Livewire\Admin\AddFunFactComponent;
use App\Http\Livewire\Admin\AddGalleryComponent;
use App\Http\Livewire\Admin\DepartmentComponent;
use App\Http\Livewire\Admin\EditBeforeComponent;
use App\Http\Livewire\Admin\HeroSliderComponent;
use App\Http\Livewire\Admin\AddCategoryComponent;
use App\Http\Livewire\Admin\AppointmentComponent;
use App\Http\Livewire\Admin\ContactFormComponent;
use App\Http\Livewire\Admin\EditContactComponent;
use App\Http\Livewire\Admin\EditFeatureComponent;
use App\Http\Livewire\Admin\EditFunFactComponent;
use App\Http\Livewire\Admin\EditGalleryComponent;
use App\Http\Livewire\Admin\TestimonialComponent;
use App\Http\Livewire\Admin\EditCategoryComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AddDepartmentComponent;
use App\Http\Livewire\Admin\AddHeroSliderComponent;
use App\Http\Livewire\Admin\AddTestimonialComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\DepartmentListComponent;
use App\Http\Livewire\Admin\EditDepartmentComponent;
use App\Http\Livewire\Admin\EditHeroSliderComponent;
use App\Http\Livewire\Admin\EditTestimonialComponent;
use App\Http\Livewire\Admin\AddDepartmentListComponent;
use App\Http\Livewire\Admin\ClosedAppointmentComponent;
use App\Http\Livewire\Admin\EditDepartmentListComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', HomeComponent::class)->name('home.index');


Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});

Route::middleware(['auth', 'autheditor'])->group(function () {
    Route::get('/editor/dashboard', UserDashboardComponent::class)->name('editor.dashboard');
});

Route::middleware(['auth', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    //Hero
    Route::get('/admin/hero', HeroSliderComponent::class)->name('admin.hero');
    Route::get('/admin/add-hero', AddHeroSliderComponent::class)->name('admin.addhero');
    Route::get('/admin/edit-hero/{slug}', EditHeroSliderComponent::class)->name('admin.edithero');
    //Features
    Route::get('/admin/features', FeatureComponent::class)->name('admin.features');
    Route::get('/admin/add-feature', AddFeatureComponent::class)->name('admin.addfeature');
    Route::get('/admin/edit-feature/{slug}', EditFeatureComponent::class)->name('admin.editfeature');
    //About us
    Route::get('/admin/about-us', AboutComponent::class)->name('admin.about');
    Route::get('/admin/add-about', AddAboutComponent::class)->name('admin.addabout');
    Route::get('/admin/edit-about/{slug}', EditAboutComponent::class)->name('admin.editabout');
    //Department
    Route::get('/admin/department', DepartmentComponent::class)->name('admin.department');
    Route::get('/admin/add-department', AddDepartmentComponent::class)->name('admin.adddepartment');
    Route::get('/admin/edit-department/{slug}', EditDepartmentComponent::class)->name('admin.editdepartment');
    //Department List
    Route::get('/admin/department-list', DepartmentListComponent::class)->name('admin.departmentlist');
    Route::get('/admin/add-department-list', AddDepartmentListComponent::class)->name('admin.adddepartmentlist');
    Route::get('/admin/edit-department-list/{slug}', EditDepartmentListComponent::class)->name('admin.editdepartmentlist');
    //Appointment
    Route::get('/admin/open-appointment', AppointmentComponent::class)->name('admin.appointment');
    Route::get('/admin/view-appointment/{slug}', AppointmentComponent::class)->name('admin.viewappointment');
    Route::get('/admin/closed-appointment', ClosedAppointmentComponent::class)->name('admin.closed');
    //Team
    Route::get('/admin/team', TeamComponent::class)->name('admin.team');
    Route::get('/admin/add-team', AddTeamComponent::class)->name('admin.addteam');
    Route::get('/admin/edit-team/{slug}', EditTeamComponent::class)->name('admin.editteam');
    //Gallery
    Route::get('/admin/gallery', GalleryComponent::class)->name('admin.gallery');
    Route::get('/admin/add-gallery', AddGalleryComponent::class)->name('admin.addgallery');
    Route::get('/admin/edit-gallery/{slug}', EditGalleryComponent::class)->name('admin.editgallery');
    //Before After
    Route::get('/admin/before-after', BeforeComponent::class)->name('admin.before');
    Route::get('/admin/add-before', AddBeforeComponent::class)->name('admin.addbefore');
    Route::get('/admin/edit-before/{slug}', EditBeforeComponent::class)->name('admin.editbefore');
    //Testimonial
    Route::get('/admin/testimonial', TestimonialComponent::class)->name('admin.testimonial');
    Route::get('/admin/add-testimonial', AddTestimonialComponent::class)->name('admin.addtestimonial');
    Route::get('/admin/edit-testimonial/{slug}', EditTestimonialComponent::class)->name('admin.edittestimonial');
    //FunFact
    Route::get('/admin/funfact', FunFactComponent::class)->name('admin.funfact');
    Route::get('/admin/add-funfact', AddFunFactComponent::class)->name('admin.addfunfact');
    Route::get('/admin/edit-funfact/{slug}', EditFunFactComponent::class)->name('admin.editfunfact');
    //FAQ
    Route::get('/admin/faq', FaqComponent::class)->name('admin.faq');
    Route::get('/admin/add-faq', AddFaqComponent::class)->name('admin.addfaq');
    Route::get('/admin/editfaq/{slug}', EditFaqComponent::class)->name('admin.editfaq');
    //Category
    Route::get('/admin/category', CategoryComponent::class)->name('admin.category');
    Route::get('/admin/add-category', AddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/admin/edit-category/{slug}', EditCategoryComponent::class)->name('admin.editcategory');
    //News letters
    Route::get('/admin/news', NewsComponent::class)->name('admin.news');
    Route::get('/admin/add-news', AddNewsComponent::class)->name('admin.addnews');
    Route::get('/admin/edit-news/{slug}', EditNewsComponent::class)->name('admin.editnews');
    //Blog
    Route::get('/admin/blog', BlogComponent::class)->name('admin.blog');
    Route::get('/admin/add-blog', AddBlogComponent::class)->name('admin.addblog');
    Route::get('/admin/edit-blog/{slug}', EditBlogComponent::class)->name('admin.editblog');
    //Logo
    Route::get('/admin/logo', LogosComponent::class)->name('admin.logo');
    Route::get('/admin/add-logo', AddLogosComponent::class)->name('admin.addlogo');
    Route::get('/admin/edit-logo/{slug}', EditLogosComponent::class)->name('admin.editlogo');
    //Contact
    Route::get('/admin/contact', ContactComponent::class)->name('admin.contact');
    Route::get('/admin/add-contact', AddContactComponent::class)->name('admin.addcontact');
    Route::get('/admin/edit-contact/{slug}', EditContactComponent::class)->name('admin.editcontact');
    Route::get('/admin/contact-form', ContactFormComponent::class)->name('admin.contactform');
});

require __DIR__ . '/auth.php';
