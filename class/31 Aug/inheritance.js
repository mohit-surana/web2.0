// Inheriting properties

function foo()
{
    this.p1 = 1;
    this.p2 = 2;
}

function bar()
{
    // foo.call(this); // Method 1
    this.p3 = 3;
    this.p4 = 4;
}

// bar.prototype = new foo(); // Method 2
obj = new bar();
