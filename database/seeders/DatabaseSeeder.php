<?php

namespace Database\Seeders;

use App\Models\PageContent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        PageContent::query()->delete();

        foreach ($this->collections() as $key => $collection) {
            PageContent::query()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => $collection['value'],
                    'description' => $collection['description'],
                ],
            );
        }
    }

    private function collections(): array
    {
        return [
            'home.hero_points' => [
                'description' => 'Homepage hero highlight pills for resources/views/frontend/home.blade.php.',
                'value' => [
                    'Positioning & messaging',
                    'Demand generation',
                    'Performance analytics',
                ],
            ],
            'home.hero_stats' => [
                'description' => 'Homepage hero panel stats for resources/views/frontend/home.blade.php.',
                'value' => [
                    ['value' => '48+', 'label' => 'Brands advised'],
                    ['value' => '3.2×', 'label' => 'Avg. pipeline lift'],
                ],
            ],
            'home.services' => [
                'description' => 'Homepage service cards for resources/views/frontend/home.blade.php.',
                'value' => [
                    [
                        'title' => 'Brand & positioning',
                        'body' => "Define who you serve, what you stand for, and the story your market remembers.\n\n- ICP & competitive mapping\n- Messaging architecture\n- Sales narrative alignment",
                    ],
                    [
                        'title' => 'Growth campaigns',
                        'body' => "Plan and launch multi-channel programs with creative and media working together.\n\n- Paid social & search\n- Email & lifecycle flows\n- Landing page strategy",
                    ],
                    [
                        'title' => 'Content & SEO',
                        'body' => "Build authority with content that ranks, educates, and supports the sales cycle.\n\n- Editorial calendars\n- Topic clusters & briefs\n- On-page optimization",
                    ],
                    [
                        'title' => 'Analytics & reporting',
                        'body' => "Connect activity to revenue with dashboards your team trusts and uses weekly.\n\n- Attribution setup\n- Executive reporting\n- Experiment roadmaps",
                    ],
                ],
            ],
            'home.steps' => [
                'description' => 'Homepage approach steps for resources/views/frontend/home.blade.php.',
                'value' => [
                    [
                        'title' => 'Diagnose',
                        'body' => 'Audit positioning, funnel performance, and team bandwidth to find the highest-leverage gaps.',
                    ],
                    [
                        'title' => 'Design',
                        'body' => 'Co-create a 90-day plan with clear owners, milestones, and metrics tied to business goals.',
                    ],
                    [
                        'title' => 'Deliver',
                        'body' => 'Hands-on support through launch — refining creative, spend, and messaging as data comes in.',
                    ],
                ],
            ],
            'home.stats' => [
                'description' => 'Homepage results metrics for resources/views/frontend/home.blade.php.',
                'value' => [
                    ['value' => '+142%', 'label' => 'Qualified leads in 6 months'],
                    ['value' => '-31%', 'label' => 'Cost per acquisition'],
                    ['value' => '2.8×', 'label' => 'Organic traffic growth'],
                ],
            ],
            'home.testimonials' => [
                'description' => 'Homepage client testimonials for resources/views/frontend/home.blade.php.',
                'value' => [
                    [
                        'quote' => 'Northline reframed our offer in two weeks. Pipeline quality improved immediately — our sales team finally had language that resonated.',
                        'name' => 'Sarah Chen',
                        'role' => 'VP Marketing, Latticeflow',
                    ],
                    [
                        'quote' => 'We brought them in for a launch sprint and stayed for ongoing advisory. Clear thinking, fast turnaround, no agency bloat.',
                        'name' => 'Marcus Webb',
                        'role' => 'Founder, Harbor Studio',
                    ],
                ],
            ],
            'recruit.benefits' => [
                'description' => 'Careers page benefit rows for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    [
                        'title' => 'Ownership from day one',
                        'body' => 'You run real engagements in your first month, with partners close enough to unblock you and far enough to let you work.',
                    ],
                    [
                        'title' => 'Senior peers only',
                        'body' => 'No account layers and no timesheet theater. Everyone here plans, sells, and ships client work.',
                    ],
                    [
                        'title' => 'Sustainable pace',
                        'body' => 'Core hours, meeting-light Wednesdays, and summer Fridays. Consulting without the burnout math.',
                    ],
                    [
                        'title' => 'A learning budget you actually spend',
                        'body' => 'Courses, conferences, and tools funded every year. No approval gauntlet, no receipts theater.',
                    ],
                    [
                        'title' => 'Shared upside',
                        'body' => 'Every full-time teammate shares in referral and retention bonuses, with a clear path to partner.',
                    ],
                ],
            ],
            'recruit.roles' => [
                'description' => 'Careers page open role rows for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    [
                        'title' => 'Growth Lead',
                        'type' => 'Full-time',
                        'location' => 'Chicago or remote (US)',
                        'summary' => 'Own three to four retainer clients end to end: positioning, paid and lifecycle programs, and the weekly metric review.',
                    ],
                    [
                        'title' => 'Senior Content Strategist',
                        'type' => 'Full-time',
                        'location' => 'Remote (US)',
                        'summary' => 'Turn client positioning into editorial systems — topic clusters, briefs, and content that sales actually forwards.',
                    ],
                    [
                        'title' => 'Marketing Analytics Manager',
                        'type' => 'Full-time',
                        'location' => 'Chicago or remote (US)',
                        'summary' => 'Stand up attribution and executive dashboards our clients check without being asked to.',
                    ],
                    [
                        'title' => 'Brand Design Partner',
                        'type' => 'Contract',
                        'location' => 'Remote',
                        'summary' => 'Embed with strategy sprints to ship identity systems, landing pages, and campaign creative.',
                    ],
                ],
            ],
            'recruit.process' => [
                'description' => 'Careers page hiring process steps for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    [
                        'title' => 'Intro call',
                        'body' => 'Thirty minutes with a partner about what you want next — no whiteboard, no trick questions.',
                    ],
                    [
                        'title' => 'Craft exercise',
                        'body' => 'A scoped, paid exercise of two to three hours modeled on real client work. We share feedback either way.',
                    ],
                    [
                        'title' => 'Team deep-dive',
                        'body' => 'Ninety minutes with the people you would work with daily. Bring hard questions about how we run engagements.',
                    ],
                    [
                        'title' => 'Offer',
                        'body' => 'A straight answer within five business days, with compensation up front and an onboarding plan attached.',
                    ],
                ],
            ],
            'recruit.testimonials' => [
                'description' => 'Careers page team quotes for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    [
                        'quote' => 'I joined for the client list and stayed for the ownership. Month one I was leading a launch sprint — with backup, never with babysitting.',
                        'name' => 'Priya Natarajan',
                        'role' => 'Growth Lead, since 2021',
                    ],
                    [
                        'quote' => "It's the first consulting job where the pace is planned. We scope honestly, we staff lightly, and nobody performs busyness.",
                        'name' => 'Dan Okafor',
                        'role' => 'Analytics Manager, since 2022',
                    ],
                ],
            ],
        ];
    }
}
