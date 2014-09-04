# Agile Design Patterns
_An accepted solution for a common problem_
		
## Strategy Pattern
- **When**: Flexibility and reusability is more important than simplicity.
- **Why**: Use it to implement big, interchangeable chunks of complicated logic, while keeping a common algorithm signature.
- **Example**

		interface Strategy
		{
			public function firstStep();
			
			public function secondStep();
			
			public function thirdStep();
		}
		
		class StrategyA
		{
			public function firstStep()
			{
				// Change made by first step
			}
			
			public function secondStep()
			{
				// Change made by second step
			}
			
			public function thirdStep()
			{
				// Change made by third step
			}
		}
		
		class StrategyB
		{
			public function firstStep()
			{
				// Change made by first step
			}
			
			public function secondStep()
			{
				// Change made by second step
			}
			
			public function thirdStep()
			{
				// Change made by third step
			}
		}
		
		class Stub
		{
			public function foo(Strategy $strategy)
			{
				$strategy->firstStep();
				$strategy->secondStep();
				$strategy->thirdStep();
			}
		}
		
## Facade Pattern
- **When**: To simplify your API or intentionally conceal inner business logic.
- **Why**: You can control the API and the real implementations and logic independently.
- **Example**
	
		class StubsFacade
		{
			private $container;
			
			public function __construct(Container $container)
			{
				$this->container = $container;
			}
			
			public function findStubs($input)
			{
				// Do job A
				// Do job B
				// Do job C
				...
				// Do job N
				
				return $result;
			}
		}
		
## Observer Pattern
- **Intent**: In the Observer pattern a `subject` object will _notify_ an `observer` object if the subject's state _changes_.
- **Types**:
	- **Polling** – Objects accept subscribers. Subscribers observe the object and are notified on specific events. Subscribers ask the observed objects for more information in order to take an action.
	- **Push** – Like the polling method, objects accept subscribers, and subscribers are notified when an event occurs. But when a notification happens, the observer also receives a hint that the observer can act on.
- **When**: To provide a notification system inside your business logic or to the outside world.
- **Why**: The pattern offers a way to communicate events to any number of different objects.
- **Example**

		interface Observer
		{
			public function onUpdate(Subject $subject);
		}

		abstract class Observable
		{
			private $observers = [];
			
			public function register(Observer $observer)
			{
				$this->observers[] = $observer;
			}

			public function unregister(Observer $observer)
			{
				foreach($this->observers as $index => $o) {
					if ($observer === $o) {
						unset($this->observers[$index]);
					}
				}
			}

			public function notify()
			{
				foreach($this->observers as $observer) {
					$observer->onUpdate($this);
				}
			}
		}

		class User extends Observable
		{
			private $username;

			public function setUsername($username)
			{
				$this->username = $username;
				$this->notify();
			}
		}

		class Notifier implements Observer
		{
			public function onUpdate(Subject $subject)
			{
				$this->pushNotification("Informations of user has been changed!");
			}

			private function pushNotification($message)
			{
				Log::info($message);
			}
		}

## Mediator Pattern
- **Intent**
	- Define an object that encapsulates how a set of objects interact. Mediator promotes loose coupling by keeping objects from referring to each other explicitly, and it lets you vary their interaction independently.
	- Design an intermediary to decouple many peers.
	- Promote the many-to-many relationships between interacting peers to "full object status".
- **When**: The affected objects can not know about the observed objects.
- **Why**: To offer a hidden mechanism of affecting other objects in the system when one object changes.
- **Example**

		class Mediator
		{
			private $observered;
			
			private $afftecter;
			
			public function __construct(Observable $observered, Affecter $afftecter)
			{
				$this->observered = $observered;
				$this->afftecter = $afftecter;
			}
			
			public function update($stub)
			{
				$this->affecter->setStub($stub);
			}
		}
		
		abstract class Observable
		{
			protected $observers = [ ];

			public function register(Mediator $observer)
			{
			    $this->observers[] = $observer;
			}

			public function unregister(Mediator $observer)
			{
			    foreach ($this->observers as $index => $o) {
			        if ($observer === $o) {
			            unset( $this->observers[$index] );
			        }
			    }
	  		}
			
			public function notify(Observable $other)
			{
				foreach ($this->observers as $observer) {
					$observer->update($hint);
				}
			}
		}
		
		class Observered extends Observable
		{
			private $stub;
			
			public function setStub($stub)
			{
				$this->stub = $stub;
				
				$this->notify($stub);
			}
		}
		
		interface Affecter
		{
			public function setStub($stub);
		}
		
		class Affected implements Affecter
		{
			private $stub;
			
			public function setStub($stub)
			{
				$this->stub = $stub;
			}
		}

## Singleton Pattern
- **Intent**
	- Ensure a class has only one instance, and provide a global point of access to it.
	- Encapsulated "just-in-time initialization" or "initialization on first use".
- **Check list**
	1. Define a private static attribute in the "single instance" class.
	2. Define a public static accessor function in the class.
	3. Do "lazy initialization" (creation on first use) in the accessor function.
	4. Define all constructors to be protected or private.
	5. Clients may only use the accessor function to manipulate the Singleton.
- **When**: You need to achieve singularity and want a cross platform, lazily evaluated solution which also offers the possibility of creation through derivation.
- **Why**: To offer a single point of access when needed.
- **Example**

		class Singleton
		{
			private static $instance;
			
			private function __construct()
			{
				// Complicated process
			}
			
			public static function getInstance()
			{
				if (! (static::$instance instanceof Singleton)) {
					static::$instance = new Singleton;
				}
				
				return static::$instance;
			}
		}


		