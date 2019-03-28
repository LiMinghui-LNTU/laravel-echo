@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-dropbox toppic-title-i"></i>
                <span class="toppic-title-span">{{$sTitle}}</span>
                <p>Designer Team</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/designer" class="w-white">{{$sTitle}}</a></span>
            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <!--about-container start-->
            <div class="about-container">
                <div class="our-team">
                    <div class="am-g">
                        @foreach($oDesigners as $designer)
                            <div class="am-u-md-3">
                                <div class="team-box">
                                    <div class="our-team-img">
                                        <img src="{{$designer->photo}}" alt=""/>
                                    </div>
                                    <div class="team_member--body">
                                        <h3 class="team_member--name">{{$designer->name}}</h3>
                                        <span class="team_member--position" style="color: red;">{{$designer->title}}</span>
                                        <span class="team_member--email">
											<a href="">{{$designer->introduction}}</a>
										</span>
                                        <ul class="team_member--links">
                                            @for($j = 0; $j < $designer->stars; $j++)
                                                <li><span class="am-icon-star am-icon-sm"></span></li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection