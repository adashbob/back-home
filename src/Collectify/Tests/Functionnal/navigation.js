casper.start('http://collectify/web/app.php?controller=category&action=list', function(){
    this.echo(this.getTitle());
});

casper.then(function(){
   this.test.assertEqual(this.getCurrentUrl(), 'http://collectify/web/app.php?controller=category&action=list');
});

casper.then(function(){
    this.clickLabel('Show');
});

casper.then(function () {
    this.echo(this.getCurrentUrl());
});

casper.thenOpen('http://localhost:8000/movies/list/', function () {
   this.echo('Symfony : '+this.getTitle());
});
casper.then(function(){
   this.clickLabel('Add movie');
});

casper.then(function () {
    this.echo('Symfony : '+this.getCurrentUrl());
});

casper.run(function(){
    this.test.done();
});
