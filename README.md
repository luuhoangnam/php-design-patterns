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
		
		