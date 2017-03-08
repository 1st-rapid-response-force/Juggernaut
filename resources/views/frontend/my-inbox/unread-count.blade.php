<?php $count = Auth::user()->newThreadsCount(); ?>
@if($count > 0)
    <span class="label pull-right label-danger">{!! $count !!}</span>
@endif