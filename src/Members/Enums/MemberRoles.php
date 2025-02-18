<?php

declare(strict_types=1);

namespace ArtisanBuild\Hallway\Members\Enums;

use ArtisanBuild\FatEnums\Attributes\WithData;
use ArtisanBuild\FatEnums\Traits\HasKeyValueAttributes;
use Illuminate\Support\Str;

enum MemberRoles: int
{
    use HasKeyValueAttributes;

    case Owner = 0;
    case Admin = 1;

    case Moderator = 2;

    case Member = 3;

    case ReadOnlyMember = 4;

    // Bot Roles
    case ModeratorBot = 21;
    case ReadWriteBot = 22;
    case ReadBot = 23;

    // Guest Role
    #[WithData(['id' => 244416654529658880])]
    case Guest = 98;

    // Role does not matter at all
    case All = 99;

    public function isBot(): bool
    {
        // TODO: Is this faster than a match statement or in_array or something else?
        return Str::endsWith('Bot', $this->name);
    }

    public function hasCommunityWritePrivileges(): bool
    {
        return ! in_array($this, [self::ReadOnlyMember, self::ReadBot], true);
    }

    public function getColor(): string
    {
        /**
         * Available Flux Badge Colors:
         * zinc, red, orange, amber, yellow, lime,
         * green, emerald, teal, cyan, sky, blue,
         * indigo, violet, purple, fuchsia, pink, rose
         */

        return match ($this) {
            self::Owner         => 'red',
            self::Admin         => 'yellow',
            self::Moderator     => 'lime',
            self::Member        => 'sky',
            self::ReadOnlyMember => 'indigo',
            self::ModeratorBot  => 'violet',
            self::ReadWriteBot  => 'purple',
            self::ReadBot       => 'rose',
            default => 'gray',
        };
    }
}
