<style>
.navbar {
	margin-bottom:-1px;
    border-radius:0;
}

#submenu {
    background-color: #e7e7e7;
    margin-bottom:20px;
}

.collapsing {
	display:none;
}

</style>
<div class="container">
  <nav class="navbar navbar-default" role="navigation" id="topmenu">
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" data-toggle="collapse" data-target="#one">One</a>
      </li>
      <li class="dropdown">
        <a href="#" data-toggle="collapse" data-target="#two">Two</a>
      </li>
      <li class="dropdown">
        <a href="#" data-toggle="collapse" data-target="#three">Three</a>
      </li>
    </ul>
   </div>
  </nav>
<div class="container">
  <nav class="navbar navbar-default" role="navigation" id="submenu">
    <ul class="nav navbar-nav collapse" id="one">
      <li><a href="#" id="">One sub 1</a></li>
      <li><a href="#" id="">One sub 2</a></li>
      <li><a href="#" id="">One sub 3</a></li>
      <li><a href="#" id="">One sub 4</a></li>
    </ul>
    <ul class="nav navbar-nav collapse" id="two">
      <li><a href="#" id="">Two sub 1</a></li>
      <li><a href="#" id="">Two sub 2</a></li>
      <li><a href="#" id="">Two sub 3</a></li>
    </ul>
     <ul class="nav navbar-nav collapse" id="three">
      <li><a href="#" id="">Three sub 1</a></li>
      <li><a href="#" id="">Three sub 2</a></li>
    </ul>
  </nav>
</div>

<script type= text/javascript>
$('.collapse').on('shown.bs.collapse', function (e) {
  $('.collapse').not(this).removeClass('in');
});

$('[data-toggle=collapse]').click(function (e) {
  $('[data-toggle=collapse]').parent('li').removeClass('active');
  $(this).parent('li').toggleClass('active');
});
</javascript>
