# Agile Design Patterns
_An accepted solution for a common problem_

## Factory Pattern
- **When**: Use a Factory Pattern when you find yourself writing code to gather information necessary to create objects.
- **Why**: Factories help to contain the logic of object creation in a single place. They can also break dependencies to facilitate loose coupling and dependency injection to allow for better testing.

## Visitor Pattern
- **When**: A decorator is not appropriate and some extra complexity is acceptable.
- **Why**: To allow and organized approach to defining functionality for several objects but at the price of higher complexity.
- Example code

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
		
- Test Code

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
	
	
