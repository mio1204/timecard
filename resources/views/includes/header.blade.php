<style>
  .header {
    height: 80px;
    margin-left: 20px;
  }

  .header-logo {
    font-size: 1.5rem;
    line-height: 80px;
  }

  .flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .header-nav-item {
    margin: 0 30px;
    font-size: 14px;
    font-weight: bold;
  }

@media screen and (max-width: 480px) {
  .header-nav {
    flex-direction: column;
  }
}
</style>

<div class="header flex">
  <h2 class="header-logo"><a href="/">Atte</a></h2>

  @if(Request::is('/', 'attendance*', 'users', 'user_attendance*'))
    <ul class="header-nav flex ">
      <li class="header-nav-item"><a href="/">ホーム</a></li>
      <li class="header-nav-item"><a href="attendance">日付一覧</a></li>
      <li class="header-nav-item"><a href="users">社員一覧</a></li>
  @if(Auth::check())
      <li class="header-nav-item"><a href="{{route('logout')}}">ログアウト</a></li>
  @else
      <li class="header-nav-item"><a href="{{route('logout')}}">ログイン</a></li>
  @endif
    </ul>
  @endif
</div>