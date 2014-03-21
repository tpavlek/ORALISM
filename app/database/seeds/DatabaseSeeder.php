<?php

class DatabaseSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Eloquent::unguard();

    $this->call('PersonUserSeeder');
  }

}

class PersonUserSeeder extends Seeder {

  public function run() {
    $person = Person::create(array('first_name' => "Troy",
                         'last_name' => 'Pavlek',
                         'address' => "edmonton",
                         'email' => "tpavlek@ualberta.ca",
                         'phone' => "17802003304"
          ));

    $user = User::create(array('user_name' => 'tpavlek',
                               'password' => Hash::make("wow"),
                               'class' => 'a',
                               'date_registered' => new DateTime('NOW'),
          ));
  }
}
