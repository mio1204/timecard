<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <style>
    html,
    body,
    div,
    span,
    object,
    iframe,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    blockquote,
    pre,
    abbr,
    address,
    cite,
    code,
    del,
    dfn,
    em,
    img,
    ins,
    kbd,
    q,
    samp,
    small,
    strong,
    sub,
    sup,
    var,
    b,
    i,
    dl,
    dt,
    dd,
    ol,
    ul,
    li,
    fieldset,
    form,
    label,
    legend,
    table,
    caption,
    tbody,
    tfoot,
    thead,
    tr,
    article,
    aside,
    canvas,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section,
    summary,
    time,
    mark,
    audio,
    video {
      margin: 0;
      padding: 0;
      border: 0;
      outline: 0;
      font-size: 100%;
      vertical-align: baseline;
      background: transparent;
    }

    a {
      text-decoration: none;
      color: #2B2E2E;
    }

    ul {
      list-style: none;
    }

    body {
      color: #2B2E2E;
    }

    .main-content {
      width: 100vw;
      background: #fbfcfe;
      min-height: 80vh;
      position: relative;
      padding-bottom: 60px;
      box-sizing: border-box;
    }

    .main-content-card {
      width: 70%;
      margin: 0 auto;
      padding-top: 50px;
      text-align: center;
    }

    .mb-20 {
    margin-bottom: 20px;
  }
    .content-title {
      display: inline-block;
      margin-left: 20px;
      margin-right: 20px;
    }

/* 打刻ページ */
.button-timecard {
  width: 90%;
  height: 120px;
  margin: 20px 0;
  font-size: 16px;
  font-weight: bold;
  background-color: #fff;
  border: 1px solid #fbfcfe;
  cursor: pointer;
  transition: 0.4s;
}

.timecard-container {
  display: flex;
}

.form-timecard {
  width: 90%;
  margin: 0 auto;
}

/* ログイン・新規登録共通 */
.form {
  width:90%;
  margin: 0 auto;
}

.input-content {
      width: 50%;
      line-height: 35px;
      padding: 5px;
      border-radius: 5px;
      border: 2px solid lightgray;
      background: #fbfcfe;
      font-size: 14px;
      box-sizing: border-box;
  }

  .button {
      text-align: center;
      width: 50%;
      padding: 5px;
      line-height: 35px;
      border: 2px solid #73B3C1;
      font-size: 14px;
      color: #fff;
      background-color: #73B3C1;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.4s;
  }

  .msg-alter {
    margin: 0;
    font-size: 12px;
    color: gray;
  }

  .link-alter {
    font-size: 12px;
    color: #73B3C1;
  }

  .error-msg {
    color:#CC3333;
  }

</style>
</head>

<body>
  <header>
    @include('includes.header')
  </header>

  <main>
    <div class="main-content">
      <div class="main-content-card">
        @yield('content')
      </div>
    </div>
  </main>

  <footer>
    @include('includes.footer')
  </footer>

</body>
</html>