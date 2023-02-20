@include('template.header')
@include('template.navbar')
<section style="padding-top: 55px; display: flex; justify-content: center; align-items: center; min-height: 100vh">
  <form action="" method="post">
    @csrf
    <div class="" style="display: flex; justify-content: center; align-content: center; flex-wrap: wrap; flex-direction: column; padding: 30px 10px; box-shadow: 0px 0px 3px black; width: 300px; border-radius: 15px; gap: 15px">
        <h1 style="text-align: center">Log in</h1>
        <input style="border-radius: 4px" type="text" name="username" placeholder="username" id="username" autofocus required>
        <input style="border-radius: 4px" type="text" name="password" placeholder="password" id="password" required>
        <div style="display: flex; justify-content: center; align-content: center;">
            <button style="border-radius: 5px; width: 100px">submit</button>
        </div>
    </div>
    <div class="" style="display: flex; justify-content: center; align-content: center; flex-direction: row;">
        <span>register&nbsp;</span>
        <a href="/signup" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">here</a>
    </div>
  </form>
</section>
