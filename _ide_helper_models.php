<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property string $id
 * @property string $thumbnail
 * @property string $name
 * @property string $description
 * @property string $person_in_charge
 * @property string $start_date
 * @property string $end_date
 * @property numeric $amount
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DevelopmentApplicant> $DevelopmentApplicant
 * @property-read int|null $development_applicant_count
 * @method static \Database\Factories\DevelopmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development wherePersonInCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Development withoutTrashed()
 */
	class Development extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $development_id
 * @property string $user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Development $development
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\DevelopmentApplicantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant whereDevelopmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DevelopmentApplicant withoutTrashed()
 */
	class DevelopmentApplicant extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $thumbnail
 * @property string $name
 * @property string $description
 * @property numeric $price
 * @property string $date
 * @property string $time
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EventParticipant> $eventParticipants
 * @property-read int|null $event_participants_count
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event withoutTrashed()
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $event_id
 * @property string $head_of_family_id
 * @property int $quantity
 * @property numeric $total_price
 * @property string $payment_status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\HeadOfFamily $headOfFamily
 * @method static \Database\Factories\EventParticipantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant search(?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant whereHeadOfFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventParticipant withoutTrashed()
 */
	class EventParticipant extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $head_of_family_id
 * @property string $user_id
 * @property string $profile_picture
 * @property string $identity_number
 * @property string $gender
 * @property string $date_of_birth
 * @property string $phone_number
 * @property string $occupation
 * @property string $marital_status
 * @property string $relation
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HeadOfFamily $headOfFamily
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\FamilyMemberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereHeadOfFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FamilyMember withoutTrashed()
 */
	class FamilyMember extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $user_id
 * @property string $profile_picture
 * @property string $identity_number
 * @property string $gender
 * @property string $date_of_birth
 * @property string $phone_number
 * @property string $occupation
 * @property string $marital_status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialAssistanceRecipient> $SocialAssitanceRecipients
 * @property-read int|null $social_assitance_recipients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EventParticipant> $eventParticipants
 * @property-read int|null $event_participants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FamilyMember> $familyMembers
 * @property-read int|null $family_members_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\HeadOfFamilyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeadOfFamily withoutTrashed()
 */
	class HeadOfFamily extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $tokenable_type
 * @property string $tokenable_id
 * @property string $name
 * @property string $token
 * @property string|null $abilities
 * @property string|null $last_used_at
 * @property string|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereAbilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereTokenableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereTokenableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalAccessToken whereUpdatedAt($value)
 */
	class PersonalAccessToken extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $thumbnail
 * @property string $name
 * @property string $about
 * @property string $headman
 * @property int $people
 * @property numeric $agricultural_area
 * @property numeric $total_area
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProfileImage> $profileImages
 * @property-read int|null $profile_images_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereAgriculturalArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereHeadman($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile wherePeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereTotalArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profile withoutTrashed()
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $profile_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProfileImage withoutTrashed()
 */
	class ProfileImage extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $thumbnail
 * @property string $name
 * @property string $category
 * @property string $amount
 * @property string $provider
 * @property string $description
 * @property bool $is_available
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialAssistanceRecipient> $SocialAssistanceRecipient
 * @property-read int|null $social_assistance_recipient_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance search(?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistance withoutTrashed()
 */
	class SocialAssistance extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $social_assistance_id
 * @property string $head_of_family_id
 * @property string $amount
 * @property string $reason
 * @property string $bank
 * @property int $account_number
 * @property string|null $proof
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HeadOfFamily $headOfFamily
 * @property-read \App\Models\SocialAssistance $socialAssistance
 * @method static \Database\Factories\SocialAssistanceRecipientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient search(?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereHeadOfFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereSocialAssistanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialAssistanceRecipient withoutTrashed()
 */
	class SocialAssistanceRecipient extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DevelopmentApplicant> $DevelopmentApplicant
 * @property-read int|null $development_applicant_count
 * @property-read \App\Models\FamilyMember|null $familyMember
 * @property-read \App\Models\HeadOfFamily|null $headOfFamily
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User search($search)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

