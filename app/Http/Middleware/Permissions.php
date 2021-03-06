<?php

namespace App\Http\Middleware;

use Closure;
use Permission; 

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Permission::canAction()){
            return redirect()->action($request->user()->default_page());
        }
        return $next($request);
    }
}


//无：000 读取 001 添加 002 修改 003 读取添加 005 读取修改 006 读取修改添加 007

// ADTables->{
//     ADTableByAccount ---------------- 单个账户的合并表 switch - account
//     ADTableByAccounts --------------- 多个账户的合并表  switch - accounts | user
//     ADTableByUser ------------------- 一个用户合并表 switch - user
//     ADTableByUsers ------------------ 多个用户合并表 switch - users
// }->{
//     byTime    --------------------- 时间分配表
//     byMax     --------------------- 大小分配表
//     byMin     --------------------- 大小分配表
// }->page;

// ADTable->{
//     index,update,create,del,empty
// }
   
// Users->{
//     addUser,delUser, updateUser,
// }->page;

// ADTableStyle->{
//     index,update,create,del,empty
// }
// ADAccount->{
//     index,update,create,del,empty
// }
// ADAccountStyle->{
//     index,update,create,del,empty
// }
// ADVps->{
//     index,update,create,del,empty
// }
// Site->{
//     index,update,create,del,empty
// }


