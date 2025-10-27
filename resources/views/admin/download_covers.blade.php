<x-layouts.vinylshop>
    <x-slot name="description">Download covers</x-slot>
    <x-slot name="title">Download covers</x-slot>
    <div class="max-w-3xl">
        <?php
        $download_url = "https://pverhaert.sinners.be/covers_vinylshop.zip";
        $download_to = "storage/covers.zip";
        $extract_path = "storage/";
        $covers_path = "storage/covers/";

        // Check if storage symlink exists, if not create it
        if (!file_exists(public_path('storage'))) {
            try {
                // Create symlink programmatically using Artisan
                Artisan::call('storage:link');
                echo "<p class='text-green-600 mb-4'>Storage symlink created successfully!</p>";
            } catch (Exception $e) {
                echo "<p class='text-yellow-600 mb-4'>Failed to create storage symlink with Artisan. Trying alternative method...</p>";

                // Alternative method if Artisan fails
                try {
                    symlink(storage_path('app/public'), public_path('storage'));
                    echo "<p class='text-green-600 mb-4'>Storage symlink created successfully with alternative method!</p>";
                } catch (Exception $e2) {
                    echo "<p class='text-red-600 mb-4'>Failed to create storage symlink: " . $e2->getMessage() . "</p>";
                    echo "<p class='text-red-600 mb-4'>You may need to run 'php artisan storage:link' manually or create a route that calls 'Artisan::call(\"storage:link\")'.</p>";
                }
            }
        }

        try {
            // Use stream context to handle timeouts and show progress
            $context = stream_context_create([
                'http' => [
                    'timeout' => 30 // 30 seconds timeout
                ]
            ]);

            echo "<p>Downloading file from <b>$download_url</b>.</p>";
            $contents = file_get_contents($download_url, false, $context);

            if ($contents === false) {
                throw new Exception("Failed to download the file.");
            }

            // Create directory if it doesn't exist
            if (!file_exists(dirname($download_to))) {
                mkdir(dirname($download_to), 0755, true);
            }

            file_put_contents($download_to, $contents);
            echo "<p class='my-2'>File downloaded successfully.</p>";

            $zip = new ZipArchive;
            $res = $zip->open($download_to);

            if ($res === TRUE) {
                // Create extraction directory if it doesn't exist
                if (!file_exists($extract_path)) {
                    mkdir($extract_path, 0755, true);
                }

                $zip->extractTo($extract_path);
                $zip->close();
                echo "<p>File extracted successfully to <b>{$extract_path}app/public/covers</b></p>";

                // Clean up the zip file
                unlink($download_to);

                // Display the downloaded images
                if (file_exists($covers_path) && is_dir($covers_path)) {
                    $images = scandir($covers_path);
                    $imageCount = count(array_filter($images, function($item) {
                        return $item !== '.' && $item !== '..';
                    }));

                    if ($imageCount > 0) {
                        echo "<h3 class='text-xl font-bold mt-6 mb-4'>Downloaded covers ($imageCount):</h3>";
                        echo "<div class='flex flex-wrap justify-between mt-6 gap-4'>";
                        foreach ($images as $image) {
                            if ($image !== '.' && $image !== '..') {
                                echo "<a href='/" . $covers_path . $image . "' target='_cover' class='hover:opacity-80 transition-opacity'>";
                                echo "<img src='/" . $covers_path . $image . "' class='size-40 rounded-md shadow-md' alt='" . htmlspecialchars($image) . "' loading='lazy'>";
                                echo "</a>";
                            }
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No images found in the extracted folder.</p>";
                    }
                } else {
                    echo "<p class='text-yellow-600'>Covers directory not found after extraction.</p>";
                }
            } else {
                echo "<p class='text-red-600'>Couldn't open zip file: " . zipFileErrorMessage($res) . "</p>";
            }
        } catch (Exception $e) {
            echo "<p class='text-red-600'>An error occurred: <br>" . $e->getMessage() . "</p>";
        }

        // Helper function to translate ZipArchive error codes into human-readable messages
        function zipFileErrorMessage($code) {
            $errors = [
                ZipArchive::ER_EXISTS => 'File already exists',
                ZipArchive::ER_INCONS => 'Zip archive inconsistent',
                ZipArchive::ER_INVAL => 'Invalid argument',
                ZipArchive::ER_MEMORY => 'Memory allocation failure',
                ZipArchive::ER_NOENT => 'No such file',
                ZipArchive::ER_NOZIP => 'Not a zip archive',
                ZipArchive::ER_OPEN => 'Can\'t open file',
                ZipArchive::ER_READ => 'Read error',
                ZipArchive::ER_SEEK => 'Seek error'
            ];

            return isset($errors[$code]) ? $errors[$code] : "Unknown error ($code)";
        }
        ?>
    </div>
</x-layouts.vinylshop>
