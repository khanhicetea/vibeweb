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
            'recruit.hero_stats' => [
                'description' => 'Recruit page hero panel stats for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    ['value' => '14', 'label' => 'Teammates'],
                    ['value' => '2019', 'label' => 'Independent since'],
                ],
            ],
            'recruit.values' => [
                'description' => 'Recruit page value cards for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    [
                        'title' => 'Small teams, real ownership',
                        'body' => 'You will run engagements end to end with two or three colleagues, not a pyramid of reviewers. Your name is on the work.',
                    ],
                    [
                        'title' => 'Craft is the strategy',
                        'body' => 'We sell thinking that ships. Slides exist to align the room; the deliverable is the change in the numbers.',
                    ],
                    [
                        'title' => 'Time to think',
                        'body' => 'No utilization targets and no timesheet theater. Focused weeks make better work, so we protect them.',
                    ],
                    [
                        'title' => 'Share in the upside',
                        'body' => 'Profit share twice a year and a learning budget you set yourself. Growth should not need a form.',
                    ],
                ],
            ],
            'recruit.perks' => [
                'description' => 'Recruit page perks strip for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    'Profit share, twice a year',
                    'Health, dental & vision',
                    '30 days paid time off',
                    '$2,500 learning budget',
                    'Hybrid, Chicago HQ',
                    'Home office stipend',
                ],
            ],
            'recruit.roles' => [
                'description' => 'Recruit page open roles list for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    [
                        'title' => 'Senior Growth Strategist',
                        'team' => 'Strategy',
                        'type' => 'Full-time',
                        'location' => 'Chicago or remote (US)',
                        'body' => 'Lead client engagements from diagnosis through launch. You will own the narrative, the plan, and the weekly cadence with client teams.',
                    ],
                    [
                        'title' => 'Performance Marketing Lead',
                        'team' => 'Campaigns',
                        'type' => 'Full-time',
                        'location' => 'Chicago, hybrid',
                        'body' => 'Run paid social and search programs end to end, from media plan to creative testing to the report the CEO actually reads.',
                    ],
                    [
                        'title' => 'Marketing Analyst',
                        'team' => 'Analytics',
                        'type' => 'Full-time',
                        'location' => 'Remote (US)',
                        'body' => 'Build the dashboards and attribution views behind every recommendation. SQL and curiosity required; agency experience optional.',
                    ],
                ],
            ],
            'recruit.steps' => [
                'description' => 'Recruit page hiring process steps for resources/views/frontend/recruit.blade.php.',
                'value' => [
                    [
                        'title' => 'Intro call',
                        'body' => 'A 30-minute conversation about your work and what you want next. No whiteboard puzzles.',
                    ],
                    [
                        'title' => 'Craft exercise',
                        'body' => 'A paid mini-brief drawn from a real past project, capped at four hours, reviewed with the team who wrote it.',
                    ],
                    [
                        'title' => 'Team conversations',
                        'body' => 'Meet the people you would work with. Two rounds, one week, and the same questions every time.',
                    ],
                    [
                        'title' => 'Offer',
                        'body' => 'We share the full package in writing and connect you with a future teammate before you decide.',
                    ],
                ],
            ],
        ];
    }
}
