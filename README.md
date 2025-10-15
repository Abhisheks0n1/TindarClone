Tinder Clone (Laravel + React Native)

A full-stack Tinder-style app built with Laravel 11 (PHP backend) and React Native (mobile frontend).  
The system includes user authentication, likes/dislikes, recommendations, cron jobs, and Swagger API documentation.

 Overview

Backend (Laravel)
The backend provides:
User management with name, age, pictures, location, and email/password login.
Like & Dislike APIs to swipe right/left.
Recommendations API — shows users you haven’t liked/disliked yet.
Authentication using Laravel Sanctum.
Cron job to notify admin when users get more than 50 likes.
Swagger UI for API documentation.

 Frontend (React Native)
The mobile app provides:
Swipe deck using `react-native-deck-swiper` (Tinder-style cards).
Like/Dislike with API calls.
List of liked users.
Splash screen, main swipe screen, and liked list screen.
State management using Recoil.
Data fetching via React Query.



 Backend Setup Summary

 Structure


tinder-backend/
├── app/
│   ├── Console/Commands/CheckPopularUsers.php
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   └── UserController.php
│   └── Models/
│       ├── User.php
│       ├── Like.php
│       └── Dislike.php
├── database/migrations/
├── database/seeders/UserSeeder.php
├── routes/api.php
└── config/l5-swagger.php



 Features
Authentication: Register/Login with Sanctum tokens.
User APIs:
  - `/api/recommended` – Get list of people not yet liked/disliked.
  - `/api/like/{id}` – Like a person.
  - `/api/dislike/{id}` – Dislike a person.
  - `/api/liked` – View list of liked people.
Cron Command: `users:check-popular` emails admin for users with >50 likes.
Swagger Docs: Available at `/api/documentation`.

 Local Run
1. Configure `.env` with DB and mail credentials.  
2. Run migrations and seed users.  
3. Start server → `php artisan serve`.  
4. Test APIs on Postman or Swagger UI (`/api/documentation`).



  Frontend Setup Summary

 Structure


TinderClone/
├── src/
│   ├── atoms/
│   ├── molecules/
│   ├── organisms/
│   │   └── SwipeDeck.js
│   ├── pages/
│   │   ├── Splash.js
│   │   ├── Main.js
│   │   └── LikedList.js
│   ├── services/api.js
│   └── state/userState.js
└── App.js



 Key Libraries
Recoil → global state for user/token  
React Query → data fetching  
Axios → API service  
React Navigation → screen routing  
react-native-deck-swiper → swipeable Tinder-style cards

 App Flow
1. Splash screen shows logo briefly.
2. Main screen displays swipe deck.
   - Swipe right → like user  
   - Swipe left → dislike user  
3. Liked list shows all liked users.
4. Uses token-based auth stored via Recoil.

 Pages
Splash.js → Startup screen  
Main.js → Displays swipe deck  
LikedList.js → Shows all liked users



 API Summary

| Endpoint | Method | Auth | Description |
|--|||-|
| `/api/register` | POST |  | Register new user |
| `/api/login` | POST |  | Login user |
| `/api/recommended` | GET |  | Get recommended people |
| `/api/like/{id}` | POST |  | Like a user |
| `/api/dislike/{id}` | POST |  | Dislike a user |
| `/api/liked` | GET |  | List liked users |



 Cron Job
Command: `php artisan users:check-popular`  
- Runs daily via Laravel scheduler.  
- Emails admin if any user has more than 50 received likes.



 API Documentation
- Generate Swagger: `php artisan l5-swagger:generate`

Author
Abhishek Soni  
Full Stack Developer — Laravel + React Native  


