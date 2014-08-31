# Agile Design Patterns
_An accepted solution for a common problem_

## Factory Pattern
- **When**: Use a Factory Pattern when you find yourself writing code to gather information necessary to create objects.
- **Why**: Factories help to contain the logic of object creation in a single place. They can also break dependencies to facilitate loose coupling and dependency injection to allow for better testing.

## Visitor Pattern
- **When**: A decorator is not appropriate and some extra complexity is acceptable.
- **Why**: To allow and organized approach to defining functionality for several objects but at the price of higher complexity.
- Example

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
		
- Test

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
- Example

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
		
- Test

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
- Example

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

