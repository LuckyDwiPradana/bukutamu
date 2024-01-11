<?php
require 'BukuTamu.php'; // File yang berisi logika CRUD bukutamu

class BukuTamuTest extends PHPUnit\Framework\TestCase {
    public function testCreateEntry() {
        $bukuTamu = new BukuTamu();
        $entryId = $bukuTamu->createEntry('John Doe', 'Hello, this is a test entry.');

        $this->assertGreaterThan(0, $entryId);
    }

    public function testReadEntry() {
        $bukuTamu = new BukuTamu();
        $entry = $bukuTamu->readEntry(1);

        $this->assertNotNull($entry);
        // Add more assertions based on the expected data
    }

    public function testUpdateEntry() {
        $bukuTamu = new BukuTamu();
        $result = $bukuTamu->updateEntry(1, 'Jane Doe', 'Updated test entry.');

        $this->assertTrue($result);
    }

    public function testDeleteEntry() {
        $bukuTamu = new BukuTamu();
        $result = $bukuTamu->deleteEntry(1);

        $this->assertTrue($result);
    }
}
?>