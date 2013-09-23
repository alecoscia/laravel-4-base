<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
</div>

<div class="collapse navbar-collapse navbar-ex1-collapse">

	@if (!empty($leftMenus))
	<ul class="nav navbar-nav">
	@foreach ($leftMenus as $topMenu)
		@if (!empty($topMenu['subMenu']))
			<li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown">
		@elseif (!empty($topMenu['url']))
			<li><a href="{{ $topMenu['url'] }}">
		@else
			<li><a href="">
		@endif

		@if (!empty($topMenu['glyph']))
			{{ HTML::glyph($topMenu['glyph']) }} 
		@endif
		{{ $topMenu['title'] }}

		@if (!empty($topMenu['subMenu']))
			<b class="caret"></b>
		@endif

		</a>

		@if (!empty($topMenu['subMenu']))
			<ul class="dropdown-menu">
			@foreach ($topMenu['subMenu'] as $subItem)
				<li><a href="{{ $subItem['url'] }}">
				@if (!empty($subItem['glyph']))
					{{ HTML::glyph($subItem['glyph']) }} 
				@endif
				{{ $subItem['title'] }}
				</a></li>
			@endforeach
			</ul>
		@endif

		</li>
	@endforeach
	</ul>
	@endif

	@if (!empty($rightMenus))
	<ul class="nav navbar-nav navbar-right">
	@foreach (array_reverse($rightMenus) as $topMenu)
		@if (!empty($topMenu['subMenu']))
			<li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown">
		@elseif (!empty($topMenu['url']))
			<li><a href="{{ $topMenu['url'] }}">
		@else
			<li><a href="">
		@endif

		@if (!empty($topMenu['glyph']))
			{{ HTML::glyph($topMenu['glyph']) }} 
		@endif
		{{ $topMenu['title'] }}

		@if (!empty($topMenu['subMenu']))
			<b class="caret"></b>
		@endif

		</a>

		@if (!empty($topMenu['subMenu']))
			<ul class="dropdown-menu">
			@foreach ($topMenu['subMenu'] as $subItem)
				<li><a href="{{ $subItem['url'] }}">
				@if (!empty($subItem['glyph']))
					{{ HTML::glyph($subItem['glyph']) }} 
				@endif
				{{ $subItem['title'] }}
				</a></li>
			@endforeach
			</ul>
		@endif

		</li>
	@endforeach
	</ul>
	@endif

</div>