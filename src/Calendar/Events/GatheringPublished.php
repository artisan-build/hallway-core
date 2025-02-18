<?php

declare(strict_types=1);

namespace ArtisanBuild\Hallway\Calendar\Events;

use ArtisanBuild\Hallway\Members\Enums\MemberRoles;
use Thunk\Verbs\Event;

class GatheringPublished extends Event
{
    public array $authorized_member_roles = [
        MemberRoles::Owner,
        MemberRoles::Admin,
    ];
}
