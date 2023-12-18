@include('layouts.topmain')
<div>
    @if (Auth::guard('api')->check())
        <div class="doimatkhau">
            <h3>Đổi mật khẩu người dùng</h3>
         <div class="loisuse">   {{ $loi }}</div>
            <div>
                        
                <form class="form" method="post" action="/trangchu/doimatkhau" enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                <div class="input-container">
                    <input type="hidden" name ='iduser'value="{{ $infouser->id }}">
                    <input type="password" name="txtpascu" placeholder="Mật khẩu cũ" required>
                    <input type="password" name="txtmatkhaumoi" placeholder="Mật khẩu mới" required>
                    <input type="password" name="txtmatkhaumoixn" placeholder="Mật khẩu mới" required>
                   
                    <button type="submit" class="submit">
                    Đổi
                    </button>
                </div>
                </form>
         
            </div>
                  
          
          </div>
		@endif
</div>
@include('layouts.bottommain')