<?php

namespace App\Http\Middleware\custom;

use App\Models\ProjectPage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        return $next($request);
        if( Auth::check() )
        {
           
            if (getUSerRole()==1){
                return $next($request);
            }
            elseif ($request->route()->getName() == 'admin.dashboard'){
                return $next($request);
            }
            else{
               
                $project_pages = ProjectPage::get();
                foreach ($project_pages as $project_page){
                    $inner_routes = explode(",",$project_page['inner_routes']);
                    if (isset($project_page['inner_routes']) && in_array($request->route()->getName(),$inner_routes)){
                        $page_id = $project_page['id'];
                        $user_permission = \App\Models\UserPermission::where('user_id',Auth::user()->id)
                            ->where('project_page_id',$page_id)
                            ->where(function($query) {
                                $query->where('can_read',1)
                                    ->orWhere('can_write', 1)
                                    ->orWhere('can_delete', 1);
                            })
                            ->first();
                            
                        if ($user_permission){
                            if ($request->route()->getName()=='admin.users.edit' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.users.changeuserstatus' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.users.permission' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.users.delete' && $user_permission->can_delete == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.categories.edit' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.categories.changeCategorystatus' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.categories.delete' && $user_permission->can_delete == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.tags.edit' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.tags.changeTagstatus' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.tags.delete' && $user_permission->can_delete == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.fields.add' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.fields.edit' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.fields.delete' && $user_permission->can_delete == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.social_platform.add' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.social_platform.edit' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.social_platform.delete' && $user_permission->can_delete == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.influencers.changeInfluencerstatus' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.influencers.edit' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else if ($request->route()->getName()=='admin.influencers.delete' && $user_permission->can_delete == 0){
                                return redirect(route('admin.403_page'));
                            }else if ($request->route()->getName()=='admin.settings.edit' && $user_permission->can_write == 0){
                                return redirect(route('admin.403_page'));
                            }
                            else{
                                return $next($request);
                            }
                        }

                        else{
                            return redirect(route('admin.403_page'));
                        }

                    }
                }
            }
        }

        abort(404);
    }
}
