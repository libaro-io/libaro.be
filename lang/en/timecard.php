<?php
return [
    'integration' => [
        'title' => 'Timecard App x ROBAWS',
        'efficiency' => 'Take efficiency to the next level',
        'intro' => [
            'heading' => 'General',
            'paragraph_1' => 'The Timecard App simplifies the daily performance tracking for team leaders in the construction sector. The seamless integration with Robaws ensures that all performance data is effortlessly processed into work orders, progress reports, and invoicing within Robaws.',
        ],
        'what_is_it' => [
            'heading' => 'What exactly does it entail?',
            'paragraph_1' => 'With this integration, team and site managers can easily record <strong>hour registrations</strong>, <strong>material usage</strong>, <strong>equipment management</strong>, <strong>waste registrations</strong>, and <strong>travel logs</strong> through a user-friendly interface. This information is automatically processed and synchronized daily with the Robaws ERP system, ensuring your data is always up-to-date.',
            'paragraph_2' => 'A key advantage of this integration is the ability to, <strong>in the form of a work order</strong>, <strong>link all costs directly to specific projects</strong>, which provides a clear overview of expenses and budgets. By monitoring revenue versus costs in real-time, integrated with your Robaws account, you can efficiently manage work orders, progress reports, and invoicing, leading to accurate profit calculation.',
            'paragraph_3' => 'Furthermore, the <strong>automatic synchronization</strong> allows you to maintain a complete overview of all ongoing projects without manual entry into multiple systems. If necessary, data can be easily adjusted and resent.',
            'paragraph_4' => 'In addition to recording work resources, automatically linking work orders, etc., the app offers a few unique functionalities. Thanks to a smart algorithm, the app <strong>automatically suggests performance entries</strong> based on previous days.',
            'paragraph_5' => 'Consequently, you can easily review or adjust these suggestions as needed. Additionally, the app makes it possible to <strong>enter performance data for colleagues</strong>. This is especially useful when team members are unable to complete their own registrations. This ensures the work order always remains complete and up-to-date.',
        ],
        'benefits' => [
            'heading' => 'Benefits of the integration',
            'paragraph' => 'The link with Robaws offers numerous benefits for companies striving for more efficient work processes and better project control:',
            'list_1' => '<strong>Efficient cost management:</strong> Keep a close eye on budgets and prevent unexpected overruns with real-time insight into project costs.',
            'list_2' => '<strong>Time savings:</strong> Save valuable hours by automatically recording and synchronizing data, reducing the need for manual entry.',
            'list_3' => '<strong>User-friendly interface:</strong> With an intuitive and simple user experience, all team members can easily record their hours and material usage.',
            'list_4' => '<strong>Better project control:</strong> Closely track the progress of projects and the use of resources for more efficient management.',
            'list_5' => '<strong>Seamless integration:</strong> The integration effortlessly fits into your existing workflows and optimizes collaboration between different departments.',
        ],
        'implementation' => [
            'heading' => 'How is this implemented in your workflow?',
            'paragraph_1' => 'The implementation of the integration is simple and fast. The process includes the following steps:',
            'list_1' => '<strong>Activation:</strong> We ensure the app is customized for your company and linked to your existing Robaws account and data.',
            'list_2' => '<strong>Documentation:</strong> We provide clear instructions on how to use the app. If needed, we can set up a short video call for a demo.',
            'list_3' => '<strong>Support:</strong> The integration is continuously maintained and improved to provide the best experience for all users. The implementation requires minimal effort from your team and ensures your company benefits from a more efficient way of working almost immediately.',
        ],
        'questions' => 'Do you have any further questions or need support?',
        'click_here' => 'Click here',
    ],
    'support' => [
        'title' => 'Timecard App Support Page',
        'documentation' => [
            'heading' => 'Documentation',
            'manual' => 'Manual',
        ],
        'faq' => [
            'heading' => 'FAQ',
            'questions' => [
                'how_to_sync_robaws' => [
                    'question' => 'How does the synchronization between the app and Robaws work?',
                    'answer' => 'All entered daily reports are automatically synchronized with Robaws daily at 23:59. You don\'t need to do anything for this.',
                ],
                'edit_after_sync' => [
                    'question' => 'Can I edit a daily report after synchronization?',
                    'answer' => 'Yes, you can use the "clear from ERP" function to revert a report to an editable status. After that, you can synchronize it with Robaws again.',
                ],
                'articles_not_visible' => [
                    'question' => 'What should I do if certain items or materials are not visible in the app?',
                    'answer' => 'Check if the items are correctly classified in an item group in Robaws. Only items in a valid category are displayed in the app.',
                ],
                'user_roles' => [
                    'question' => 'Can I set user roles or access rights in the app?',
                    'answer' => 'Yes, the app distinguishes between user roles, such as site managers and admins. A user\'s role can be adjusted by admins. This can be done on the users page in the Timecard App.',
                ],
                'no_internet' => [
                    'question' => 'What happens if my internet connection temporarily drops?',
                    'answer' => 'The PWA has limited offline functionalities. An internet connection will be required to use them.',
                ],
                'vehicles_and_equipment' => [
                    'question' => 'How are vehicles and equipment displayed in the app?',
                    'answer' => 'Vehicles and equipment are automatically synchronized from Robaws and classified based on the categories you have set up in Robaws.',
                ],
                'multiple_projects' => [
                    'question' => 'Is the integration suitable for multiple projects at once?',
                    'answer' => 'Yes, you can manage and report on multiple projects in the app. Each report is linked to the correct project within Robaws.',
                ],
                'correct_sync' => [
                    'question' => 'How do I know for sure that my data has been synchronized correctly?',
                    'answer' => 'A confirmation is displayed in the app after synchronization. You can also check in Robaws to see if a new work order has been added under "werkbonnen" (work orders).',
                ],
                'error_messages' => [
                    'question' => 'What should I do if I get error messages?',
                    'answer' => 'Check if your app is up-to-date. If the problem persists, please contact info@libaro.be for technical support.',
                ],
                'pricing_structure' => [
                    'question' => 'What is the pricing structure for using this app?',
                    'answer' => 'It is a subscription model that costs €49 / team leader per month. This includes: an unlimited number of employees per team leader in your team, as well as integration, technical support, and ongoing updates and upgrades.',
                ],
            ],
        ],
        'installation_instructions' => [
            'heading' => 'Installation Instructions',
            'description' => 'Instructions for installing a PWA (Progressive Web App) on iOS and Android devices.',
            'ios' => [
                'heading' => 'iOS',
                'step_1' => 'Open Safari on your iPhone.',
                'step_2' => 'Navigate to <a href="https://timecard.libaro.io/">https://timecard.libaro.io/</a> in the Safari address bar.',
                'step_3' => 'Tap the "Share" icon (square with an upward arrow) at the bottom of the screen.',
                'step_4' => 'In the menu that appears, scroll down and tap "Add to Home Screen".',
                'step_5' => 'Tap "Add" in the upper right corner of the screen.',
                'step_6' => 'The app will now be added to your iPhone\'s Home Screen. You can open the app by tapping the new icon.',
            ],
            'android' => [
                'title' => 'Android',
                'step_1' => 'Open Google Chrome on your Android device.',
                'step_2' => 'Navigate to <a href="https://timecard.libaro.io/">https://timecard.libaro.io/</a> in the Chrome address bar.',
                'step_3' => 'Tap the Menu icon (three vertical dots) in the upper right corner of the screen.',
                'step_4' => 'In the opened menu, tap "Add to Home Screen" or "Install app" (depending on your Android version).',
                'step_5' => 'If desired, adjust the name of the app and tap "Add" or "Install" to add the PWA to your Home Screen.',
                'step_6' => 'The PWA will now be added to your Android device\'s Home Screen. You can open the app by tapping the new icon.',
            ],
            'further_help' => [
                'support_inquiry' => 'Do you have further questions or need support?',
                'team_ready' => 'Our team is ready to help you!',
                'email' => 'info@libaro.be',
                'availability' => 'We are available Monday to Friday from 09:00 to 17:00.',
            ],
        ],
    ],
];
