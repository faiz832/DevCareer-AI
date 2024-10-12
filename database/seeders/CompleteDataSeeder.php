<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseVideo;
use App\Models\CourseStudent;
use App\Models\SubscribeTransaction;
use App\Models\User;
use App\Models\Teacher;

class CompleteDataSeeder extends Seeder
{
    public function run()
    {
        // Kategori
        $categories = [
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Mobile Development', 'slug' => 'mobile-development'],
            ['name' => 'Data Science', 'slug' => 'data-science'],
            ['name' => 'Machine Learning', 'slug' => 'machine-learning'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Courses
        $teacherId = Teacher::first()->id; // Assumes you have at least one teacher

        $courses = [
            [
                'name' => 'Introduction to HTML and CSS',
                'slug' => 'introduction-to-html-and-css',
                'about' => 'Learn the basics of web development with HTML and CSS',
                'thumbnail' => 'courses/html-css-thumbnail.jpg',
                'category_id' => 1,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/qz0aGYrrlhU',
            ],
            [
                'name' => 'Responsive Web Design',
                'slug' => 'responsive-web-design',
                'about' => 'Create responsive web pages that look great on all devices',
                'thumbnail' => 'courses/responsive-web-design-thumbnail.jpg',
                'category_id' => 1,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/0N7Xc84O-1M',
            ],
            [
                'name' => 'CSS Grid and Flexbox',
                'slug' => 'css-grid-and-flexbox',
                'about' => 'Learn advanced CSS layout techniques with Grid and Flexbox',
                'thumbnail' => 'courses/css-grid-flexbox-thumbnail.jpg',
                'category_id' => 1,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/1Rs2ND1ryYc',
            ],
            [
                'name' => 'JavaScript Fundamentals',
                'slug' => 'javascript-fundamentals',
                'about' => 'Master the core concepts of JavaScript programming',
                'thumbnail' => 'courses/javascript-thumbnail.jpg',
                'category_id' => 1,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/W6NZfCO5SIk',
            ],
            [
                'name' => 'Python for Data Science',
                'slug' => 'python-for-data-science',
                'about' => 'Learn Python programming for data analysis and visualization',
                'thumbnail' => 'courses/python-ds-thumbnail.jpg',
                'category_id' => 3,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/LHBE6Q9XlzI',
            ],
            [
                'name' => 'Statistics for Data Science',
                'slug' => 'statistics-for-data-science',
                'about' => 'Understand statistics concepts for data analysis',
                'thumbnail' => 'courses/statistics-ds-thumbnail.jpg',
                'category_id' => 3,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/3XfXUeD0M6E',
            ],
            [
                'name' => 'Machine Learning with Python',
                'slug' => 'machine-learning-with-python',
                'about' => 'Implement machine learning algorithms using Python',
                'thumbnail' => 'courses/ml-python-thumbnail.jpg',
                'category_id' => 3,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/GwIo3gOz4M4',
            ],
            [
                'name' => 'Data Visualization with Matplotlib',
                'slug' => 'data-visualization-with-matplotlib',
                'about' => 'Create visualizations using Matplotlib in Python',
                'thumbnail' => 'courses/matplotlib-thumbnail.jpg',
                'category_id' => 3,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/X6O8Y8GQ8Y0',
            ],
            [
                'name' => 'Mobile App Development with React Native',
                'slug' => 'mobile-app-development-with-react-native',
                'about' => 'Build cross-platform mobile apps using React Native',
                'thumbnail' => 'courses/react-native-thumbnail.jpg',
                'category_id' => 2,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/0-S5a0eXPoc',
            ],
            [
                'name' => 'Flutter for Beginners',
                'slug' => 'flutter-for-beginners',
                'about' => 'Learn how to build beautiful apps with Flutter',
                'thumbnail' => 'courses/flutter-beginners-thumbnail.jpg',
                'category_id' => 2,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/5WjPfYLo9G0',
            ],
            [
                'name' => 'Kotlin for Android Development',
                'slug' => 'kotlin-for-android-development',
                'about' => 'Master Android development with Kotlin programming language',
                'thumbnail' => 'courses/kotlin-android-thumbnail.jpg',
                'category_id' => 2,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/Fj3x0qfFq44',
            ],
            [
                'name' => 'iOS Development with Swift',
                'slug' => 'ios-development-with-swift',
                'about' => 'Create iOS apps using Swift programming language',
                'thumbnail' => 'courses/ios-swift-thumbnail.jpg',
                'category_id' => 2,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/9f6X2Wf0AAw',
            ],
            [
                'name' => 'Introduction to Machine Learning',
                'slug' => 'introduction-to-machine-learning',
                'about' => 'Get started with machine learning concepts and algorithms',
                'thumbnail' => 'courses/introduction-ml-thumbnail.jpg',
                'category_id' => 4,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/0Lt9w-uB1N8',
            ],
            [
                'name' => 'Deep Learning with TensorFlow',
                'slug' => 'deep-learning-with-tensorflow',
                'about' => 'Learn to build deep learning models using TensorFlow',
                'thumbnail' => 'courses/deep-learning-tf-thumbnail.jpg',
                'category_id' => 4,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/9w8tJjL5H3c',
            ],
            [
                'name' => 'Natural Language Processing',
                'slug' => 'natural-language-processing',
                'about' => 'Understand the basics of natural language processing',
                'thumbnail' => 'courses/nlp-thumbnail.jpg',
                'category_id' => 4,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/Nw0-7r5Re3E',
            ],
            [
                'name' => 'Reinforcement Learning',
                'slug' => 'reinforcement-learning',
                'about' => 'Dive into reinforcement learning algorithms',
                'thumbnail' => 'courses/reinforcement-learning-thumbnail.jpg',
                'category_id' => 4,
                'teacher_id' => $teacherId,
                'path_trailer' => 'https://www.youtube.com/embed/2c2j54w4dMI',
            ],
        ];

        foreach ($courses as $courseData) {
            $course = Course::create($courseData);

            // Course Videos
            for ($i = 1; $i <= 5; $i++) {
                CourseVideo::create([
                    'name' => "Lesson $i: " . $course->name,
                    'path_video' => "https://www.youtube.com/embed/dQw4w9WgXcQ", // Placeholder video
                    'course_id' => $course->id,
                ]);
            }

            // Course Students
            $students = User::role('student')->take(5)->get();
            foreach ($students as $student) {
                CourseStudent::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                ]);
            }
        }

        // Subscribe Transactions
        $students = User::role('student')->take(10)->get();
        foreach ($students as $student) {
            // Create multiple transactions for each student
            for ($j = 0; $j < 3; $j++) { // Adjust the number of transactions here (e.g., 3)
                SubscribeTransaction::create([
                    'user_id' => $student->id,
                    'total_amount' => 100000, // 100,000 IDR
                    'is_paid' => 0, // Randomly paid or not
                    'proof' => 'transactions/payment-proof.jpg',
                    'subscription_start_date' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}
