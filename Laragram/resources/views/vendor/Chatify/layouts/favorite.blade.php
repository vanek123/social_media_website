<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ $user->profile->profileImage() }}');">
        </div>
        <p>{{ strlen($user->username) > 5 ? substr($user->username,0,6).'..' : $user->username }}</p>
    @endif
</div>
