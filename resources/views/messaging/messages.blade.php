@extends('layouts.layout')

@section('title')
    CP - Messages
@stop

@if($user->type == 'boat')
  @section('body-id')
      id="boats"
  @stop
@endif

@section('topbar')
  <div class="col-md-8 offset-md-1">
    <div class="topbar @if($user->type == 'boat') boatsTopbar @endif">
      <a href="#received"><h5>Received Messages</h5></a>
      <a href="#sent"><h5>Sent Messages</h5></a>
    </div>
  </div>
@stop

@section('content')
  <div class="col-md-10 offset-md-1">
    <div class="card border-primary box">
      <div class="card-body">
        <blockquote class="card-blockquote">
          <h4>My Messages</h4>
          <div class="card" id="received">
            <h5 class="card-header">Received Messages
              @unless(empty($unreadNo))
                <b id="unread"> {{ $unreadNo }} unread</b>
              @endunless
            </h5>
            <div class="card-body">
              @foreach($msgRcvd as $msg)
              <div id="{{ $msg->id }}item" class="card border-primary
              @if($msg->unread == 1)
                text-white bg-primary
              @endif
              msgListItem">
                <div class="card-body">
                  <blockquote class="card-blockquote">
                    <div id="{{$msg->id}}"></div>
                    <a class="deleteMsg" href="{{ route('deleteMsg', ['type' => 'received', 'id' => $msg->id]).'#received' }}" data-placement="bottom" title="Delete">X</a>
                    <h6>{{ $msg->created_at->format('j M Y') }}</h6>
                    <h5>From: <a href="{{ route('profile.show', $msg->from_id) }}">{{ $msg->username }}</a></h5>
                    <p id="{{ $msg->id }}subject">SUBJECT: {{ $msg->subject }}</p>
                    <a id="{{ $msg->id }}openBtn" type="{{ $msg->id }}" class="openMsg">OPEN</a>
                    <a class = "closeMsg" id="{{ $msg->id }}closeBtn">CLOSE</a>
                  </blockquote>
                </div>
              </div>
                <div id="{{ $msg->id }}preview" class="col-md-12 previewMsg">
                    <p class="lead">SUBJECT: {{ $msg->subject }}</p>
                    <p>{!! nl2br(e($msg->message)) !!}</p>
                    <a class="btn btn-outline-primary replyBtn" href="{{ route('reply', ['id' => $msg->from_id, 'backTo' => 'backtomessages']) }}">Reply</a>
                </div>
              @endforeach
              {{ $msgRcvd->links('vendor.pagination.bootstrap-4') }}
              <a class="text-muted" href="#">Back to top</a>
            </div>
          </div>
          <div class="card sentMessages" id="sent">
            <h5 class="card-header">Sent Messages</h5>
            <div class="card-body">
              @foreach($msgSent as $msg)
              <div class="card border-primary msgListItem">
                <div class="card-body">
                  <blockquote class="card-blockquote">
                    <div id="{{$msg->id}}"></div>
                    <a class="deleteMsg" href="{{ route('deleteMsg', ['type' => 'sent', 'id' => $msg->id]).'#sent' }}" data-placement="bottom" title="Delete">X</a>
                    <h6>{{ $msg->created_at->format('j M Y') }}</h6>
                    <h5>To: <a href="{{ route('profile.show', $msg->to_id) }}">{{ $msg->username }}</a></h5>
                    <p id="{{ $msg->id }}subjectSent">SUBJECT: {{ $msg->subject }}</p>
                    <a id="{{ $msg->id }}openBtnSent" type="{{ $msg->id }}" class="openMsgSent" >OPEN</a>
                    <a class = "closeMsg" id="{{ $msg->id }}closeBtnSent">CLOSE</a>
                  </blockquote>
                </div>
              </div>
                <div id="{{ $msg->id }}previewSent" class="col-md-12 previewMsg">
                    <p class="lead">SUBJECT: {{ $msg->subject }}</p>
                    <p>{!! nl2br(e($msg->message)) !!}</p>
                </div>
              @endforeach
              {{ $msgSent->links('vendor.pagination.bootstrap-4') }}
              <a class="text-muted" href="#">Back to top</a>
            </div>
          </div>
        </blockquote>
      </div>
    </div>
  </div>
@stop
