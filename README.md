# Agile Design Patterns
_An accepted solution for a common problem_

## Factory Pattern
- **When**: Use a Factory Pattern when you find yourself writing code to gather information necessary to create objects.
- **Why**: Factories help to contain the logic of object creation in a single place. They can also break dependencies to facilitate loose coupling and dependency injection to allow for better testing.

## Visitor Pattern
- **When**: A decorator is not appropriate and some extra complexity is acceptable.
- **Why**: To allow and organized approach to defining functionality for several objects but at the price of higher complexity.
- **Example**

		interface Host
		{
			public function getStubs();
			
			public function accept(Visitor $visitor);
		}

		interface Visitor
		{
			public function getStubs();
		
			public function visit(Host $host);
		}
		
		class B implements Host
		{
			public function accept(Visitor $visitor)
			{
				$visitor->visit($this);
			}
			
			public function getStubs()
			{
				return 'stubs';
			}
		}
		
		class A implements Visitor
		{
			private $stubs;
			
			public function visit(Host $b)
			{
				$this->stubs = $b->getStubs();
			}
			
			/**
			 * Get stubs of B
			 */
			public function getStubs()
			{
				return $this->stubs;
			}
		}
		
- **Test**

		class VisitorTest extends PHPUnit_Framework_TestCase
		{
			public function testACanGetStubsFromB()
			{
				// Host
				$b = new B;
				// Visitor
				$a = new A;
				
				$b->accept($a); // $b accept $a visit $b
				$stubs = $a->getStubs(); // $a can get stubs from $b when $b accepted
				
				$this->assertEquals('stubs', $stubs);
			}
		}
	
## State Pattern
- **When**: FSM-like logic is required to be implemented.
- **Why**: To eliminate the problems of a switch...case statement, and to better encapsulate the meaning of each individual state.
- **Example**

		interface Machine
		{
			public function next();
			
			public function setState(State $state);
		}
		
		interface State
		{
			public function next(Machine $machine);
		}
		
		class First implements State
		{
			public function next(Machine $machine)
			{
				$machine->setState(new Second);
			}
		}
		
		class Second implements State
		{
			public function next(Machine $machine)
			{
				$machine->setState(new Third);
			}
		}
		
		class Third implements State
		{
			public function next(Machine $machine)
			{
				$machine->setState(new Third);
			}
		}
		
		class SimpleMachine implements Machine
		{
			private $currentState;
			
			public function __construct(State $initialState)
			{
				$this->setState($initialState);
			}
			
			public function next()
			{
				$this->currentState->next();
			}
			
			public function setState(State $state)
			{
				$this->currentState = $state;
			}
			
			public function getCurrentState()
			{
				return $this->currentState;
			}
		}
		
- **Test**

		class SimpleMachineTest extends PHPUnit_Framework_TestCase
		{
			public function testItStartWithInitialState()
			{
				$machine = new SimpleMachineTest(new First);
				
				$this->assertInstanceOf('First', $machine->getCurrentState);
			}
			
			public function testItCanMoveOnNextState()
			{
				$machine = new SimpleMachineTest(new First);
				
				$machine->next();
				
				$this->assertInstanceOf('Second', $machine->getCurrentState);
				
				$machine->next();
				
				$this->assertInstanceOf('Third', $machine->getCurrentState);
			}
			
			public function testItRemainOnFinalState()
			{
				$machine = new SimpleMachineTest(new Third);
				$machine->next();
				
				$this->assertInstanceOf('Third', $machine->getCurrentState);
			}
		}
	
## Gateway Pattern
- **When**: When you need to retrieve or persist information.
- **Why**: It offers a simple public interface for complicated persistence operations. It also encapsulates persistence knowledge and decouples business logic from persistence logic.
- **Example**

		class A { }

		interface Gateway
		{
			public function persist(A $a);
			
			public function retrieve($id);
		}
		
		class FileGateway implements Gateway
		{
			public function persist(A $a)
			{
				// TODO: Store serialized an A object to filesystem
			}
			
			public function retrieve($id)
			{
				// TODO: Retrieve an A object by its id from filesystem
			}
		}
		
		public class DbGateway implements Gateway
		{
			public function persist(A $a)
			{
				// TODO: Store serialized an A object to database
			}
			
			public function retrieve($id)
			{
				// TODO: Store serialized an A object to database
			}
		}
		
## Proxy Pattern
- **When**: You have to retrieve information from a persistence layer or external source, but don't want your business logic to know this.
- **Why**: To offer a non-intrusive approach to creating objects behind the scenes. It also opens the possibility to retrieve these object on the fly, lazily, and from different sources.
- **Example**

		interface Animal
		{
			public function run();
		}

		class Cat implements Animal
		{
			public function run()
			{
				return 'Cat is running';
			}
			
			public function meow()
			{
				return 'Cat is meowing';
			}
		}
		
		class CatProxy implements Animal
		{
			private $cat;
			
			public function run()
			{
				if (is_null($this->cat))
					$this->cat = new Cat;
				
				return $this->cat->run();
			}
			
			// CatProxy only provides run() method and hide another unwanted to know methods
		}

## Repository Pattern
- **When**: You need to create multiple objects based on search criteria, or when you need to save multiple objects to the persistence layer.
- **Why**: To let clients that need specific objects to work with a common and well isolated query and persistence language. It removes even more creation-related code from the business logic.
- **Example**

		class UserRepository
		{
			private $factory;
			private $gateway;
			
			public function __construct(UserFactory $factory, UserGateway $gateway)
			{
				$this->factory = $factory;
				$this->gateway = $gateway;
			}
			
			public function findAll()
			{
				$userRecords = $this->gateway->getAllUsers();
				
				return $this->makeMultipleUser($userRecords);
			}
			
			public function findBannedUser()
			{
				$userRecords = $this->gateway->where('status', '=', 'banned')->get();
				
				return $this->makeMultipleUser($userRecords);
			}
			
			private function makeMultipleUser(array $records = [])
			{
				$users = [];
				
				foreach($records as $record)
				{
					$users[] = new User($record);
				}
				
				return $users;
			}
		}
		
- **Test**

		class UserRepositoryTest extends PHPUnit_Framework_TestCase
		{
			private $repository;
			
			public function setUp()
			{
				$this->repository = new UserRepository;
			}
			
			public function testItShouldReturnAllUsers()
			{	
				$this->assertEquals(10, $repository->findAll()); // Assume that have 10 users.
			}
			
			public function testItShouldReturnBannedUsers()
			{
				$this->assertEquals(2, $repository->findAllBannedUsers()); // Assume that have 2 users has been banned.
			}
		}
		
## Null Pattern
- **When**: You frequently check for null or you have refused bequests.
- **Why**: It can add clarity to your code and forces you to think more about the behavior of your objects.
- **Example**

		interface Product
		{
			public function getPrice();
			
			public function getName();
		}
		
		class Keyboard implements Product
		{
			public function getPrice()
			{
				return 50;
			}
			
			public function getName()
			{
				return 'Keyboard';
			}
		}

		class NullProduct extends Product
		{
			public function getPrice()
			{
				return 0;
			}
			
			public function getName()
			{
				return '';
			}
		}
		
		class ProductManager
		{
			private $products;
			
			public function addProduct(Product $product)
			{
				$this->products[] = $product;
			}
			
			public function getTotal()
			{
				$total = 0;
				foreach($this->products as $product)
				{
					$total += $product->getPrice();
				}
				
				return $total;
			}
		}

- **Test**

		class ProductManagerTest extends PHPUnit_Framework_TestCase
		{
			public function testItShouldRemainsTotalWhenAddNullProduct()
			{
				$productManager = new ProductManager;	
				$productManager->addProduct(new Keyboard);
				$total = $this->getTotal();
				
				$productManager->addProduct(new NullProduct);
				$finalTotal = $this->getTotal();
				
				$this->assertEquals(50, $total);
				$this->assertEquals(50, $finalTotal);
			}
		}
		
## Command Pattern
- **When**: When you have to perform many operations to prepare objects for use.
- **Why**: To move complexity from the consuming code to the creating code.
- **Example**

		interface Command
		{
			public function execute();
		}
		
		class MakeDirectoryCommand implements Command
		{
			public function execute()
			{
				return `mkdir stuff`;
			}
		}
		
		class ListCommand implements Command
		{
			public function execute()
			{
				return `ls -al`;
			}
		}
		
		class Program
		{
			private $commands;
			
			public function __construct()
			{
				$commands = ['MakeDirectory', 'List'];
				foreach($commands as $command)
				{
					$this->addCommand(new "{$command}Command");
				}
			}
			
			public function addCommand(Command $cmd)
			{
				$this->commands[] = $cmd;
			}
			
			public function execute()
			{
				$output = '';
				foreach($this->commands as $cmd)
				{
					$output .= $cmd->execute();
				}
				
				printf($output); // Print out all command outputs
			}
		}

## Active Object Pattern
- **What**: The Active Object Pattern decouples the method invocation from method execution.
- **When**: Several similar objects have to execute with a single command.
- **Why**: It forces clients to perform a single task and affect multiple objects.
- **Example**

		class Job
		{
			private $worker;
			
			public function __construct(Worker $worker)
			{
				$this->worker = $worker
			}
			
			public function execute()
			{
				$result = $this->doHardWork();
				
				if (!$result)
					$this->worker->enqueue($this);
			}
			
			public function doHardWork()
			{
				sleep(5);
			}
		}

		class Worker
		{
			private $jobs = [];
			
			public function enqueue(Job $job)
			{
				$this->jobs[] = $job;
			}
			
			public function run()
			{
				while($this->jobs)
				{
					$job = array_shift($this->jobs);
					
					$job->execute();
				}
			}
		}
		
- **Test**

		class WorkerTest extends PHPUnit_Framework_TestCase
		{
			public function testItCanRunJobs
			{
				$worker = new Worker;
				$jobs = $this->createJobs($worker, 100);
				
				$worker->run();
			}
			
			private function createJobs($worker, $number)
			{
				$jobs = [];
				for($i=0 ; $i < $number ; $i++)
				{
					$jobs = new Job($worker);
				}
				
				return $jobs;
			}
		}
		