<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi', 'harga', 'stok', 'gambar', 'kategori', 'best_seller'];

    /**
     * Rekomendasi produk serupa berdasarkan kemiripan deskripsi (simple cosine-like similarity)
     */
    public function getRekomendasi(int $limit = 4)
    {
        $words = $this->extractWords($this->deskripsi . ' ' . $this->nama);

        $candidates = Product::where('id', '!=', $this->id)
            ->where('kategori', $this->kategori)
            ->limit(20)
            ->get();

        if ($candidates->count() < $limit) {
            $candidates = Product::where('id', '!=', $this->id)->limit(20)->get();
        }

        return $candidates->map(function ($product) use ($words) {
            $productWords = $this->extractWords($product->deskripsi . ' ' . $product->nama);
            $product->similarity = $this->cosineSimilarity($words, $productWords);
            return $product;
        })->sortByDesc('similarity')->take($limit)->values();
    }

    private function extractWords(string $text): array
    {
        $text = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $text));
        $words = array_filter(explode(' ', $text));
        $freq = [];
        foreach ($words as $word) {
            if (strlen($word) > 2) {
                $freq[$word] = ($freq[$word] ?? 0) + 1;
            }
        }
        return $freq;
    }

    private function cosineSimilarity(array $a, array $b): float
    {
        $dot = 0;
        $magA = 0;
        $magB = 0;
        foreach ($a as $word => $count) {
            $dot += $count * ($b[$word] ?? 0);
            $magA += $count * $count;
        }
        foreach ($b as $count) {
            $magB += $count * $count;
        }
        $denom = sqrt($magA) * sqrt($magB);
        return $denom > 0 ? $dot / $denom : 0;
    }
}
