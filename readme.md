## About Cashbook

This is a simple cashbook application. Currently It has following features 

- User Authentication(username - admin@example.com, password-123456), run Users Seeder to insert this dummy user & start your application, then you can change everything using your own data

- Insert & update Cashflow(Inflow & Outflow)

- Multilingual(you can use different languages for your admin panel)

  ​

## Installation Process

You can install it as usual like other laravel project using composer. **Only difference is**  - after installation, you need to run user & language seeder. Without it these data, you can't access your dashboard. Before running seeder, please comment out LanguageServiceProvider's(app/Providers/LanguageServiceProvider) register method. Otherwise, it will throw error message. Then after completing seeding, please remove your commenting from that register method & then the system will run smoothly.

## Contributing

You can also contribute to speed up this development. Please send an email to jobayercse@gmail.com & I will inform you how to participate. 

## License

It is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
